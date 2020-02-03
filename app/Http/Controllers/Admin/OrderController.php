<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use DB;
use Carbon;

class OrderController extends Controller
{
    protected $order, $customer;

    public function __construct(Order $order, Customer $customer)
    {
        $this->order = $order;
        $this->customer = $customer;
    }

    /**
     * List orders
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['listOrders'] = $this->order
            ->orderBy('created_at', 'DESC')->with(['customer', 'ward'])
            ->get(['id', 'order_id', 'customer_id', 'address', 'ward_id', 'created_at', 'status', 'note']);
        return view('admin.order.list', $data);
    }

    /**
     * Get order's detail
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail(Order $order)
    {
        $data['detail'] = DB::table('products AS P')
            ->join('order_detail AS OD', 'OD.product_id', '=', 'P.id')
            ->where('OD.order_id', $order->id)
            ->get([
                'P.image AS product_image', 'P.name AS product_name',
                'OD.price AS price', 'OD.quantity AS quantity', 'OD.product_type AS product_type'
            ]);
        $data['order'] = $order;

//        $data['order'] = $order->with([
//            'product',
//            'order_detail',
//        ])
//            ->get(['id', 'order_id', 'pay_status', 'payment_method']);
//        foreach ($data['order']->product as $i => $product) {
//            $tr[$i] = [
//                'image' => $product->image,
//                'name' => $product->name,
//                'price' => $data['order']->order_detail[$i]->price,
//                'quantity' => $data['order']->order_detail[$i]->quantity,
//            ];
//        }
//        $data['tr'] = $tr;
        return response()->json($data, 200);
    }

    /**
     * Update order
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function updateOrder(Request $request, Order $order)
    {
        $order->fill($request->only('note', 'status', 'payment_method', 'pay_status'));
        if ($request->status == config('const.SHIPPED')) {
            $order->pay_status = config('const.PAID');
        }
        $order->save();
        return response()->json($order, 200);
    }

    public
    function getStatistics(Request $request)
    {
        $data['month'] = $request->has('month') ? $request->month : Carbon::now()->month;
        $data['year'] = $request->has('year') ? $request->year : Carbon::now()->year;
        $data['orders'] = $this->order->whereMonth('created_at', '=', $data['month'])->whereYear('created_at', '=', $data['year'])->count();
        $data['customers'] = $this->customer->whereMonth('created_at', '=', $data['month'])->whereYear('created_at', '=', $data['year'])->count();
        $data['products'] = DB::table('orders AS O')
            ->join('order_detail AS OD', 'OD.order_id', '=', 'O.id')
            ->select(DB::raw('SUM(OD.quantity) AS quantity'), DB::raw('SUM(OD.quantity * OD.price) AS money'))
            ->whereMonth('created_at', '=', $data['month'])->whereYear('created_at', '=', $data['year'])
            ->first();

        $data['listOrders'] = DB::table('customers AS C')
            ->join('orders AS O', 'O.customer_id', '=', 'C.id')
            ->join('order_detail AS OD', 'OD.order_id', '=', 'O.id')
            ->select('O.order_id as order_id', 'C.name as customer_name', 'O.created_at AS created_at', DB::raw('SUM(OD.quantity * OD.price) as money'), 'OD.quantity as quantity')
            ->whereMonth('O.created_at', '=', $data['month'])->whereYear('O.created_at', '=', $data['year'])
            ->groupby('order_id', 'customer_name', 'created_at', 'quantity')
            ->get();
        return view('admin.order.statistics', $data);
    }
}

