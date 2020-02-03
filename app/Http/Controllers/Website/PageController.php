<?php

namespace App\Http\Controllers\Website;


use App\Http\Controllers\Controller;
use App\Jobs\SendQueueMail;
use App\Mail\TestQueueEmail;
use App\Models\Category;
use App\Models\NewDetail;
use App\Models\ProductReview;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\PostCommentRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Banner;
use Cart;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Builder;

class PageController extends Controller
{
    /**
     * @var Product
     */
    protected $product, $category, $brand, $newdetail, $product_review, $banner, $product_type;

    /**
     * PageController constructor.
     * @param Product $product
     * @param Category $category
     * @param Brand $brand
     */
    public function __construct(Banner $banner, Product $product, Category $category, Brand $brand, NewDetail $newdetail, ProductReview $product_review, ProductType $product_type)
    {
        $this->product_type = $product_type;
        $this->banner = $banner;
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->newdetail = $newdetail;
        $this->product_review = $product_review;
    }

    function product_review($query)
    {
        return $query->select('product_id', DB::raw('COUNT(id) as comments'), DB::raw('SUM(star) / COUNT(star) as ave_star'))->groupby('product_id');
    }

    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['banners'] = $this->banner->get(['name', 'slug', 'image']);
        $phone = $this->category->find(config('const.PHONE'));
        $speaker = $this->category->find(config('const.SPEAKER'));
        $accessory = $this->category->find(config('const.ACCESSORY'));
        $data['phones'] = $phone->product()
            ->with([
                'product_review' => function ($query) {
                    $this->product_review($query);
                },
                'product_type',
            ])
            ->orderBy('created_at', 'DESC')->limit(8)
            ->get(['products.id', 'name', 'image', 'slug']);
        $data['speakers'] = $speaker->product()
            ->with([
                'product_review' => function ($query) {
                    $this->product_review($query);
                },
                'product_type',
            ])->orderBy('created_at', 'DESC')->limit(8)
            ->get(['products.id', 'name', 'image', 'slug']);
        $data['accessories'] = $accessory->product()
            ->with([
                'product_review' => function ($query) {
                    $this->product_review($query);
                },
                'product_type',
            ])->orderBy('created_at', 'DESC')->limit(8)
            ->get(['products.id', 'name', 'image', 'slug']);
        return view('website.index', $data);
    }

    /**
     * List products belongs category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListProduct($slug, Request $request)
    {
        $data['brands'] = Brand::all();
        $category = $this->category->whereSlug($slug)->firstOrFail();
        $price = null;
        $brand = [];
        $order_by = null;
        if ($request->has('gia')) {
            $price = $request->gia;
            $data['gia'] = $price;
        }
        if ($request->has('hang')) {
            foreach ($request->hang as $value) {
                $brand[] = $value;
            }
            $data['hang'] = $brand;
        }
        $query = $category->product()
            ->select('products.id', 'name', 'image', 'slug')
            ->where(function ($query) use ($price) {
                switch ($price) {
                    case 'duoi-1-trieu':
                        $query->where('promotion_price', '<', 1000000);
                        break;
                    case 'tu-1-3-trieu':
                        $query->whereBetween('promotion_price', [1000000, 3000000]);
                        break;
                    case 'tu-3-7-trieu':
                        $query->whereBetween('promotion_price', [3000000, 7000000]);
                        break;
                    case 'tu-7-12-trieu':
                        $query->whereBetween('promotion_price', [7000000, 12000000]);
                        break;
                    case 'tu-12-17-trieu':
                        $query->whereBetween('promotion_price', [12000000, 17000000]);
                        break;
                    case 'tren-17-trieu':
                        $query->where('promotion_price', '>', 17000000);
                        break;
                    default:
                        break;
                };
            })
            ->where(function ($query) use ($brand) {
                foreach ($brand as $value) {
                    $query->orWhere('brand_id', $value);
                }
            });
        if ($request->has('sap_xep')) {
            if ($request->sap_xep == 'gia-tang-dan') {
                $data['sap_xep'] = 'gia-tang-dan';
                $query->orderBy('promotion_price', 'ASC');
            } else if ($request->sap_xep == 'gia-giam-dan') {
                $data['sap_xep'] = 'gia-giam-dan';
                $query->orderBy('promotion_price', 'DESC');
            } else {
                $data['sap_xep'] = 'moi-nhat';
                $query->orderBy('created_at', 'DESC');
            }
        }
        $data['products'] = $query->with([
            'product_review' => function ($query) {
                $this->product_review($query);
            },
            'product_type',
        ])->paginate(12);
        $data['category'] = $category;
        return view('website.product.list_products', $data);
    }

    /**
     * Search
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchProduct(Request $request)
    {
        if ($request->has('key')) {
            $key = $request->key;
            $data['results'] = $this->product
                ->where('name', 'LIKE', "%$key%")
                ->with([
                    'product_review' => function ($query) {
                        $this->product_review($query);
                    }
                ])
                ->orderBy('created_at', 'DESC')
                ->paginate(8, ['id', 'name', 'image', 'slug']);
            return view('website.layout.search', $data);
        }
    }


    function getComment($product_id = null)
    {
        return DB::table('product_review as PR')
            ->join('products as P', 'PR.product_id', '=', 'P.id')
            ->join('customers as C', 'C.id', '=', 'PR.customer_id')
            ->where('PR.product_id', $product_id)
            ->select('PR.comment as comment', 'PR.star as star', 'PR.created_at as created_at', 'C.name as name', 'PR.customer_id as customer_id')
            ->get();
    }

    /**
     * Show product's detail
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductDetail($c_slug, $p_slug)
    {
        $_category = $this->category->where('slug', $c_slug)->first();
        if ($_category || $c_slug === 'tim-kiem') {
            $data['product'] = $this->product
                ->where('slug', $p_slug)
                ->with([
                    'product_option:product_id,option_name,option_value',
                    'product_image:product_id,image',
                    'product_relate:product_id,product_relate_id',
                    'product_type',
                ])
                ->firstOrFail(['id', 'name', 'image', 'description', 'content']);
            $arr_id = [];
            foreach ($data['product']->product_relate as $item) {
                $arr_id[] = $item->product_relate_id;
            }
            if (!empty($arr_id)) {
                $data['product_relates'] = $this->product->whereIn('id', $arr_id)->get(['image', 'slug', 'name']);
            }
            $data['comments'] = $this->getComment($data['product']->id);
            $sum_star = 0;
            $customer_id = [];
            if (count($data['comments']) > 0) {
                foreach ($data['comments'] as $item) {
                    $sum_star += $item->star;
                    $customer_id[] = $item->customer_id;
                }
                $data['ave_star'] = round($sum_star / count($data['comments']), 1);
                $data['arr_customer_id'] = $customer_id;
            }
            $data['auth'] = Auth::guard('customers')->check() ? Auth::guard('customers')->user()->id : null;
            $data['accessories'] = $this->category->find(4)->product()->limit(6)->orderBy('created_at', 'DESC')->get();
            return view('website.product.product_detail', $data);
        } else return redirect('/');
    }

    /**
     * Post product's comments
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postComment(Request $request)
    {
        $this->product_review->fill($request->only('customer_id', 'product_id', 'comment', 'star'));
        $this->product_review->customer_id = Auth::guard('customers')->user()->id;
        $this->product_review->save();
        $data['comment'] = $this->product_review;
        $data['customer'] = Auth::guard('customers')->user();
        return response()->json($data, 200);
    }

    /**
     * New's list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListNew()
    {
        $data['news'] = $this->newdetail
            ->orderBy('created_at', 'DESC')
            ->paginate(5, ['slug', 'name', 'image', 'description', 'created_at']);
        return view('website.new.list_news', $data);
    }

    /**
     * New detail
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNewDetail($slug)
    {
        $new = $this->newdetail->whereSlug($slug)->firstOrFail();
        return view('website.new.new_detail', $new);
    }

    public function getPromotionDetail($slug)
    {
        $item = $this->banner->whereSlug($slug)->firstOrFail();
        return view('website.new.banner_detail', $item);
    }

    public function getPolicy()
    {
        $new = $this->newdetail->whereSlug('chinh-sach-doi-tra-bao-hanh')->firstOrFail();
        return view('website.new.policy', $new);
    }
}
