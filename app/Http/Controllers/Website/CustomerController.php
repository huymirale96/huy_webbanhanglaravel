<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\CustomerChangeProfile;
use App\Http\Requests\CustomerResetPassword;
use App\Http\Requests\CustomerSendRequestForgotPassword;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Register;
use App\Mail\CustomerForgotPassword;
use App\Mail\CustomerRegisterSuccess;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Validate;
use Illuminate\Http\Request;
use Session;
use Auth;
use Cart;
use DB;

class CustomerController extends Controller
{
    protected $customer, $order, $orderdetail;

    /**
     * CustomerController constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer, Order $order, OrderDetail $orderDetail)
    {
        $this->customer = $customer;
        $this->orderdetail = $orderDetail;
        $this->order = $order;
    }

    /**
     * Login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = false;
        if ($request->has('remember')) {
            $remember = true;
        }
        if (Auth::guard('customers')->attempt($arr, $remember)) {
            $name = Auth::guard('customers')->user()->name;
            return response()->json($name, 200);
        }
        return response()->json('error', 500);
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Logout(Request $request)
    {
        Session::remove(Auth::guard('customers')->getName());
        return response()->json('success', 200);
    }

    /**
     * Register
     *
     * @param Register $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRegister(Register $request)
    {
        $this->customer->fill($request->only('name', 'email', 'password', 'phone', 'address'));
        $this->customer->password = bcrypt($request->password);
        $this->customer->save();
        Mail::to($this->customer->email)->send(new CustomerRegisterSuccess($this->customer));
        return response()->json(['success' => 'Data is successfully added']);
    }

    /**
     * Update profile
     *
     * @param CustomerChangeProfile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeProfile(CustomerChangeProfile $request)
    {
        if (Auth::guard('customers')->check()) {
            $customer = $this->customer->where('email', Auth::guard('customers')->user()->email)->first();
            $customer->fill($request->only('name', 'phone', 'address'));
            $customer->save();
            return response()->json($customer, 200);
        }
        return response()->json(false, 500);
    }

    /**
     * Change password
     *
     * @param ChangePassword $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePassword $request)
    {
        $user = Auth::guard('customers')->user();
        $user->password = bcrypt($request->password);
        $user->save();
        Auth::guard('customers')->logout();
        return response()->json(true, 204);
    }

    /**
     * Get list order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListOrder()
    {
        $user = $this->customer->find(Auth::guard('customers')->user()->id);
        $data['orders'] = $user->order()->orderBy('created_at', 'DESC')->get();
        $query = DB::table('orders')
            ->select('orders.id', DB::raw("SUM(B.price * B.quantity) as money"))
            ->join('order_detail as B', 'B.order_id', '=', 'orders.id')
            ->where('orders.customer_id', $user->id)
            ->groupBy('orders.id');
        $data['money'] = $query->get();
        return view('website.cart.history_order', $data);
    }

    public function getOrderDetail(Request $request)
    {
        $order = $this->order->find($request->id);
        $list = [];
        $products = $order->product()->with('product_type:product_id,stock_price')->get();
        $detail = $order->order_detail()->get();
        foreach ($products as $i => $product) {
            $list[$i] = [
                'image' => $product->image,
                'name' => $product->name,
                'product_type' => $detail[$i]->product_type,
                's_price' => $product->product_type[$i]->stock_price,
                'p_price' => $detail[$i]->price,
                'quantity' => $detail[$i]->quantity,
            ];
        }
        $data['order'] = $order;
        $data['list'] = $list;
        $data['customer'] = $this->customer->find($order->customer_id);
        $data['address'] = DB::table('wards AS W')
            ->join('districts AS D', 'D.id', '=', 'W.district_id')
            ->join('provinces AS P', 'P.id', '=', 'D.province_id')
            ->select('W.name AS w_name', 'D.name AS d_name', 'P.name AS p_name')
            ->where('W.id', '=', $order->ward_id)
            ->get();
        return response()->json($data, 200);
    }

    /**
     * Send Request Forgot Password
     *
     * @param CustomerSendRequestForgotPassword $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendRequestForgotPassword(CustomerSendRequestForgotPassword $request)
    {
        if (Auth::guard('customers')->check()) {
            Auth::guard('customers')->logout();
        }
        $email = $request->email;
        $customer = $this->customer->where('email', $email)->first();
        if ($customer) {
            $customer->token = md5(time() . str_random(50));
            $customer->token_expire = date('Y-m-d H:i:s', time());
            $customer->save();
            Mail::to($customer->email)->send(new CustomerForgotPassword($customer));
            return response()->json('success', 204);
        }
        return response()->json('error', 400);
    }


    /**
     * Check Token Forgot Password
     *
     * @param null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function checkToken($token = null)
    {
        if (Auth::guard('customers')->check()) {
            Auth::guard('customers')->logout();
        }
        $customer = $this->customer->where('token', $token)->first();
        if ($customer) {
            $time = Carbon::now()->subHours(24);
            if ($customer->token_expire >= $time) {
                return view('website.auth.forgot_password', ['customer' => $customer]);
            }
            return view('website.auth.error_token');
        }
        return view('website.auth.error_token');
    }

    public function setPassword(CustomerResetPassword $request)
    {
        if (Auth::guard('customers')->check()) {
            Auth::guard('customers')->logout();
        }
        $customer = $this->customer->where('token', $request->token)->first();
        $customer->token = null;
        $customer->token_expire = null;
        $customer->password = bcrypt($request->password);
        $customer->save();
        return response()->json('success', 204);
    }
}
