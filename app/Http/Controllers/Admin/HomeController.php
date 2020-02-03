<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Auth;
use DB;

class HomeController extends Controller
{
    public function __construct(Customer $customer, Order $order, Product $product, User $user)
    {
        $this->product = $product;
        $this->customer = $customer;
        $this->user = $user;
        $this->order = $order;
    }

    public function index()
    {
        $data['view_products'] = $this->product->count();
        $data['view_orders'] = $this->order->count();
        $data['view_users'] = $this->user->count();
        $data['view_customers'] = $this->customer->count();
        $data['money'] = DB::table('orders as O')
            ->join('order_detail as OD', 'O.id', '=', 'OD.order_id')
            ->select(DB::raw('MONTH(created_at) as x'), DB::raw('SUM(quantity * price) as y'))
            ->groupby('x')
            ->get()->toArray();
        return view('admin.index', $data);
    }
}
