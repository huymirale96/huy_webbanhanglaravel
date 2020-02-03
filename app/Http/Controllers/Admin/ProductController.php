<?php

namespace App\Http\Controllers\Admin;


use App\Models\ProductType;
use Session;
use App\Http\Requests\ProductAdd;
use App\Http\Requests\ProductEdit;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductOption;
use App\Models\ProductImage;
use App\Models\ProductRelate;
use App\Models\ProductCategory;
use SoftDeletes;
use Cacbon;
use DB;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    protected $product, $brand, $product_relate, $product_option, $product_image, $product_category, $category, $product_type;

    /**
     * ProductController constructor.
     * @param Product $product
     * @param Brand $brand
     * @param ProductRelate $product_relate
     * @param ProductOption $product_option
     * @param ProductImage $product_image
     * @param ProductCategory $product_category
     * @param Category $category
     */
    public function __construct(Product $product,
                                Brand $brand,
                                ProductRelate $product_relate,
                                ProductOption $product_option,
                                ProductImage $product_image,
                                ProductCategory $product_category,
                                Category $category,
                                ProductType $product_type)
    {
        $this->product = $product;
        $this->product_image = $product_image;
        $this->product_option = $product_option;
        $this->product_relate = $product_relate;
        $this->product_category = $product_category;
        $this->product_type = $product_type;
        $this->brand = $brand;
        $this->category = $category;
    }

    /**
     * List products
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['products'] = $this->product
            ->with('brand:id,name')
            ->withTrashed()
            ->orderBy('id', 'DESC')
            ->get(['id', 'name', 'image', 'brand_id', 'created_at', 'deleted_at']);
        return view('admin.product.list', $data);
    }

    /**
     * View create new products
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createProduct()
    {
        $data['categories'] = $this->category->all();
        $data['products'] = $this->product->all();
        $data['brands'] = $this->brand->all();
        return view('admin.product.add', $data);
    }

    /**
     * Function create new products
     *
     * @param ProductAdd $request
     * @return mixed
     */
    public function storeProduct(ProductAdd $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $this->product->fill($request->only('name', 'slug', 'image', 'description', 'content', 'brand_id'));
                $this->product->slug = str_slug($request->name);
                if ($request->hasFile('image')) {
                    $fileName = md5(time() . $request->image->getClientOriginalName()) . '.' . $request->image->getClientOriginalExtension();
                    $this->product->image = $fileName;
                    $request->image->storeAs('products', $fileName);
                }
                $this->product->save();
                $option = [];

                if ($request->has(['option_name', 'option_value'])) {
                    $this->product_option->fill($request->only('product_id', 'option_name', 'option_value'));
                    foreach ($request->option_name as $key => $name) {
                        $option[$key] = [
                            'product_id' => $this->product->id,
                            'option_name' => $name,
                            'option_value' => $request->option_value[$key],
                        ];
                    }
                    $this->product_option->insert($option);
                }

                if ($request->has(['product_type_name', 'product_type_stock_price', 'product_type_promotion_price', 'product_type_stock'])) {
                    $type = [];
                    foreach ($request->product_type_name as $key => $type_name) {
                        $type[$key] = [
                            'product_id' => $this->product->id,
                            'product_type' => $type_name,
                            'stock_price' => $request->product_type_stock_price[$key],
                            'promotion_price' => $request->product_type_promotion_price[$key],
                            'stock' => $request->product_type_stock[$key],
                        ];
                    }
                    $this->product_type->insert($type);
                }

                if ($request->hasFile('images')) {
                    $img = [];
                    $this->product_image->fill($request->only('product_id', 'image'));
                    foreach ($request->images as $key => $image) {
                        $fileName = md5(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                        $img[$key] = [
                            'product_id' => $this->product->id,
                            'image' => $fileName,
                        ];
                        $image->storeAs('products', $fileName);
                    }
                    $this->product_image->insert($img);
                }

                $relates = [];
                if (isset($request->relate)) {
                    $this->product_relate->fill($request->only('product_id', 'product_relate_id'));
                    foreach ($request->relate as $key => $item) {
                        $relates[$key]['product_id'] = $this->product->id;
                        $relates[$key]['product_relate_id'] = $item;
                    }
                    $this->product_relate->insert($relates);
                }
                $categories = [];
                if (isset($request->category)) {
                    $this->product_category->fill($request->only('product_id', 'category_id'));
                    foreach ($request->category as $key => $item) {
                        $categories[$key]['product_id'] = $this->product->id;
                        $categories[$key]['category_id'] = $item;
                    }
                    $this->product_category->insert($categories);
                }
                return redirect()->route('admin.products')->with('success', trans('flash-message.add-product-success'));
            } catch (\Exception $e) {
                return back()->with('error', trans('flash-message.add-product-error'));
            }
        });
    }

    /**
     * View edit products
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProduct(Product $product)
    {
        $data['listImages'] = $product->product_image()->get(['id', 'image']);
        $data['listBrands'] = $this->brand->all(['id', 'name']);
        $data['product'] = $product;
        $data['product_option'] = $product->product_option()->get(['id', 'option_name', 'option_value']);
        $data['product_relate'] = $product->product_relate()->get(['id', 'product_relate_id']);
        $data['product_category'] = $product->product_category()->get();
        $data['product_type'] = $product->product_type()->get();
        $data['listProducts'] = $this->product->get(['id', 'name']);
        $data['listCategories'] = $this->category->get(['id', 'name']);
        return view('admin.product.edit', $data);
    }

    /**
     * Function update products
     *
     * @param ProductEdit $request
     * @param Product $product
     * @return mixed
     */
    public function updateProduct(ProductEdit $request, Product $product)
    {
        return DB::transaction(function () use ($request, $product) {
            try {
                $cur_image = $product->image;
                $product->fill($request->only(
                    'name', 'slug', 'image', 'brand_id', 'description', 'content'
                ));
                if ($request->hasFile('image')) {
                    if ($cur_image != null) {
                        unlink(storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $cur_image);
                    }
                    $fileName = md5(time() . $request->image->getClientOriginalName()) . '.' . $request->image->getClientOriginalExtension();
                    $product->image = $fileName;
                    $request->image->storeAs('products', $fileName);
                }
                $product->save();

                if (!empty($request->category)) {
                    $category = [];
                    $_cur = $product->product_category()->get();
                    foreach ($_cur as $key => $value) {
                        $_new[$key] = $value->id;
                    }
                    foreach ($request->category as $key => $item) {
                        if (!empty($_new) && !in_array($item, $_new)) {
                            $category[$key]['product_id'] = $product->id;
                            $category[$key]['category_id'] = $item;
                        } else if (empty($_new)) {
                            $category[$key]['product_id'] = $product->id;
                            $category[$key]['category_id'] = $item;
                        }
                    }
                    $this->product_category->insert($category);
                }

                if (!empty($request->relate)) {
                    $relate = [];
                    $_cur = $product->product_relate()->get();
                    foreach ($_cur as $key => $value) {
                        $_new[$key] = $value->id;
                    }
                    foreach ($request->relate as $key => $item) {
                        if (!empty($_new) && !in_array($item, $_new)) {
                            $relate[$key]['product_id'] = $product->id;
                            $relate[$key]['product_relate_id'] = $item;
                        } else if (empty($_new)) {
                            $relate[$key]['product_id'] = $product->id;
                            $relate[$key]['product_relate_id'] = $item;
                        }
                    }
                    $this->product_relate->insert($relate);
                }

                if ($request->has(['option_name', 'option_value'])) {
                    $option = [];
                    if (!empty($product->product_option())) {
                        $product->product_option()->delete();
                    }
                    foreach ($request->option_name as $key => $name) {
                        $option[$key] = [
                            'product_id' => $product->id,
                            'option_name' => $name,
                            'option_value' => $request->option_value[$key],
                        ];
                    }
                    $this->product_option->insert($option);
                }

                if ($request->has(['product_type_name', 'product_type_stock_price', 'product_type_promotion_price', 'product_type_stock'])) {
                    $type = [];
                    if (!empty($product->product_type())) {
                        $product->product_type()->delete();
                    }
                    foreach ($request->product_type_name as $key => $type_name) {
                        $type[$key] = [
                            'product_id' => $product->id,
                            'product_type' => $type_name,
                            'stock_price' => $request->product_type_stock_price[$key],
                            'promotion_price' => $request->product_type_promotion_price[$key],
                            'stock' => $request->product_type_stock[$key],
                        ];
                    }
                    $this->product_type->insert($type);
                }

                if ($request->hasFile('images')) {
                    $img = [];
                    foreach ($request->images as $key => $image) {
                        $fileName = md5(time() . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                        $img[$key] = [
                            'product_id' => $product->id,
                            'image' => $fileName,
                        ];
                        $image->storeAs('products', $fileName);
                    }
                    $this->product_image->insert($img);
                }
                return redirect()->route('admin.products')->with('success', trans('flash-message.edit-product-success'));
            } catch (\Exception $e) {
                return back()->with('error', trans('flash-message.edit-product-error'));
            }
        });
    }

    /**
     * Function delete products
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteProduct(Product $product)
    {
        $product->delete();
        return response()->json($product, 200);
    }

    /**
     * Function delete product's images
     *
     * @param ProductImage $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteImage(ProductImage $image)
    {
        unlink(storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $image->image);
        $image->delete();
        return response()->json(['id' => $image->id]);
    }

    /**
     * Function delete product's option
     *
     * @param ProductOption $option
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteOption(ProductOption $option)
    {
        $option->delete();
        return response()->json(['id' => $option->id]);
    }

    /**
     * Function restore products
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreProduct($id)
    {
        $product = $this->product->onlyTrashed()->find($id);
        $product->restore();
        return response()->json($product, 200);
    }
}
