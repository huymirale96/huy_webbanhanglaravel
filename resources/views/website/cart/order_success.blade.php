@extends('website.layout.index')
@section('title', 'Thanh toán thành công')
@section('container')
    <!-- history order -->
    <div class="terms py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <div style="margin: auto" class="product-sec1 col-md-8 col-lg-8 col-sm-12 col-xs-12">
                <!-- tittle heading -->
                <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                    <span>T</span>hanh
                    <span>T</span>oán
                    <span>T</span>hành
                    <span>C</span>ông
                </h3>
                <!-- //tittle heading -->
                <div class="row">
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Mã đơn hàng: </label><span> {{ $order->order_id }}</span>
                    </div>
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Thời gian
                            đặt: </label><span> {{ date('d/m/Y - H:i:s', strtotime($order->created_at)) }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Khách hàng: </label><span> {{ $customer->name }}</span>
                    </div>
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Trạng thái: </label>
                        <span>
                            @switch($order->status)
                                @case(0) Chờ xác nhận
                                @break
                                @case(1) Đã xác nhận
                                @break
                                @case(2) Đang giao hàng
                                @break
                                @case(3) Đã giao hàng
                                @break
                                @case(4) Đã hủy
                            @endswitch
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Email: </label><span> {{ $customer->email }}</span>
                    </div>
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Số điện thoại: </label><span> {{ $customer->phone }}</span>
                    </div>
                </div>
                <div class="form-group row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label style="font-weight: bold">Địa chỉ:</label>
                    <span>&nbsp{{ $order->address . ', ' . $order->ward->name . ', ' . $order->ward->district->name . ', ' . $order->ward->district->province->name }}</span>
                </div>
                <div class="form-group row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label style="font-weight: bold">Ghi chú: </label><span>&nbsp{{ $order->note }}</span>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Trạng thái thanh toán: </label>
                        <span>
                            @if ($order->pay_status == config('const.PAID'))
                                Đã thanh toán
                            @else Chờ thanh toán
                            @endif
                        </span>
                    </div>
                    <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label style="font-weight: bold">Phương thức thanh toán: </label>
                        <span>
                            @if ($order->payment_method == config('const.ATM'))
                                Thanh toán qua VNPay
                            @else Thanh toán tiền mặt
                            @endif
                        </span>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-primary">
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền (vnđ)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detail as $item)
                            <tr>
                                <td><img height="80px"
                                         src="{{ asset('storage/app/products/' . $item->options->image) }}" alt=""></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ number_format($item->qty * $item->price) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4"><b>Tổng thanh toán (vnđ)</b></td>
                            <td>{{ number_format($total_money) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- cart -->
@stop
