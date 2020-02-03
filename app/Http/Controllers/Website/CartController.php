<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\SubmitOrder;
use App\Mail\OrderSuccess;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Province;
use App\Models\Ward;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * @var Product
     */
    protected $product, $order, $order_detail, $province, $district, $ward, $product_type;

    /**
     * CartController constructor.
     * @param Product $product
     * @param Order $order
     * @param OrderDetail $order_detail
     * @param Province $province
     * @param District $district
     * @param Ward $ward
     */
    public function __construct(Product $product, ProductType $product_type, Order $order, OrderDetail $order_detail, Province $province, District $district, Ward $ward)
    {
        $this->product_type = $product_type;
        $this->product = $product;
        $this->order = $order;
        $this->order_detail = $order_detail;
        $this->province = $province;
        $this->district = $district;
        $this->ward = $ward;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['carts'] = Cart::content();
        $data['count'] = Cart::count();
        $data['money'] = Cart::total();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->product->findOrFail($request->id);
        $product_type = $this->product_type->findOrFail($request->type_id);
        $cart = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product_type->promotion_price,
            'weight' => 0,
            'options' => [
                'image' => $product->image,
                'product_type' => $product_type->product_type,
            ],
        ]);
        return response()->json($cart, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
        $cart = Cart::get($id);
        $data['product'] = $this->product::find($cart->id);
        if ($request->quantity <= $data['product']->stock) {
            Cart::update($id, $request->quantity);
            $data['money'] = Cart::total();
            return response()->json($data, 200);
        }
        return response()->json(false, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['product'] = $this->product::find(Cart::get($id)->id);
        Cart::remove($id);
        $data['money'] = Cart::total();
        return response()->json($data, 200);
    }

    /**
     * Get user's info to fill in Form
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        if (Auth::guard('customers')->check()) {
            $user = Auth::guard('customers')->user();
            return response()->json($user, 200);
        }
        return response()->json(false, 404);
    }

    /**
     * Get districts after choosing province
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrict(Request $request)
    {
        $districts = $this->district->where('province_id', $request->id)->get(['id', 'name']);
        return response()->json($districts, 200);
    }

    /**
     * Get wards after choosing district
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWard(Request $request)
    {
        $wards = $this->ward->where('district_id', $request->id)->get(['id', 'name']);
        return response()->json($wards, 200);
    }

    /**
     * Confirm order
     *
     * @param Request $request
     * @return mixed
     */
    public function ConfirmOrder(SubmitOrder $request)
    {
        return DB::transaction(function () use ($request) {
            $this->order->fill($request->all())->save();
            $this->order->order_id = 'S.' . time() . '.' . $this->order->id;
            $this->order->payment_method = config('const.COD');
            $this->order->pay_status = config('const.UN_PAID');
            $this->order->save();
            $order = $this->order;
            $customer = $order->customer()->first();
            $order_detail = Cart::content();
            $total_money = str_replace('.', '', Cart::total());
            foreach ($order_detail as $key => $item) {
                $detail[] = [
                    'order_id' => $this->order->id,
                    'product_id' => $item->id,
                    'product_type' => $item->options->product_type,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ];
            }
            $this->order_detail->insert($detail);
            Mail::to($customer->email)
                ->send(new OrderSuccess($order, $customer, $order_detail, $total_money));
            Cart::destroy();
            return response()->json(true, 204);
        });
    }

    public function deleteAllCart(Request $request)
    {
        Cart::destroy();
        return response()->json(204);
    }

    function PayURL($money = 0, $order_id = null)
    {
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay');
        $vnp_TmnCode = "FEST0RT1";
        $vnp_HashSecret = "ZFUIJSMWYLIKQTEAJLGOTIRAQUQAESPW";

        $vnp_TxnRef = $order_id;
        $vnp_Amount = $money * 100;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => 'vn',
            "vnp_OrderInfo" => 'Thanh toan STARPHONE',
            "vnp_OrderType" => 'billpayment',
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    public function confirmOrderVnpay(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $this->order->fill($request->all())->save();
            $this->order->order_id = 'S.' . time() . '.' . $this->order->id;
            $this->order->payment_method = config('const.ATM');
            $this->order->pay_status = config('const.UN_PAID');
            $this->order->save();
            $cart = Cart::content();
            $total_money = Cart::total();
            foreach ($cart as $key => $item) {
                $detail[] = [
                    'order_id' => $this->order->id,
                    'product_id' => $item->id,
                    'product_type' => $item->options->product_type,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ];
            }
            $this->order_detail->insert($detail);
            $money = (float)str_replace('.', '', $total_money);
            $order_id = 'S.' . time() . '.' . $this->order->id;
            $vnp_Url = $this->PayURL($money, $order_id);
            return response()->json($vnp_Url, 200);
        });
    }

    public function vnpayreturn(Request $request)
    {
        $order_id = $request->vnp_TxnRef;
        $data['total_money'] = $total_money = $request->vnp_Amount;
        $data['order'] = $order = $this->order->where('order_id', $order_id)->first();
        $order->pay_status = config('const.PAID');
        $order->save();
        $data['products'] = $order->product()->get();
        $data['customer'] = $customer = $order->customer()->first();
        $data['detail'] = $order_detail = Cart::content();
        Mail::to($customer->email)
            ->send(new OrderSuccess($order, $customer, $order_detail, $total_money));
        Cart::destroy();
        return view('website.cart.order_success', $data);
    }
}
