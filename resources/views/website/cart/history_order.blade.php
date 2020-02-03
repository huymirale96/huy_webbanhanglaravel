@extends('website.layout.index')
@section('title', 'Lịch sử đặt hàng')
@section('container')
    <!-- history order -->
    <div class="terms py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>L</span>ịch
                <span>S</span>ử
                <span>Đ</span>ặt
                <span>H</span>àng
            </h3>
            <!-- //tittle heading -->
            <table class="table table-bordered">
                <thead>
                <tr class="bg-primary">
                    <th width="20%">Số đơn hàng</th>
                    <th width="20%">Ngày mua</th>
                    <th width="20%">Tổng tiền (vnđ)</th>
                    <th width="20%">Trạng thái</th>
                    <th width="20%">Chi tiết</th>
                </tr>
                </thead>
                <tbody>
                <style>
                    label {
                        font-weight: bold;
                    }
                </style>
                @if (!empty($orders))
                    @foreach($orders as $key1 => $item1)
                        @foreach($money as $key2 => $item2)
                            @if ($item2->id === $item1->id)
                                <tr>
                                    <td>{{ $item1->order_id }}</td>
                                    <td>{{ date('d/m/Y - H:i:s', strtotime($item1->created_at)) }}</td>
                                    <td>{{ number_format($item2->money) }}</td>
                                    <td>
                                        @switch($item1->status)
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
                                    </td>
                                    <td>
                                        <button data-url="{{ route('customer.order_detail') }}"
                                                data-id="{{ $item1->id }}"
                                                data-toggle="modal" data-target="#modal-order-detail"
                                                class="btn btn-info btn-order-detail">Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- cart -->
    <div id="modal-order-detail" class="modal fade" aria-hidden="true" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="bill" class="col-md-5"></span>
                    <span class="col-md-5" id="created_at"></span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <label>Khách hàng:</label><span id="cart_name"></span>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <label>Trạng thái:</label><span id="cart_status"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <label>Email:</label> <span id="cart_email"></span>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <label>Số điện thoại:</label> <span id="cart_phone"></span>
                        </div>
                    </div>
                    <div class="form-group row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Địa chỉ:</label> <span id="cart_address"> </span>
                    </div>
                    <div class="form-group row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Ghi chú:</label> <span id="cart_note"> </span>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <label>Trạng thái thanh toán: </label> <span id="pay_status"></span>
                        </div>
                        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <label>Phương thức thanh toán: </label> <span id="payment_method"></span>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-primary">
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá khuyến mãi</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền (vnđ)</th>
                        </tr>
                        </thead>
                        <tbody class="new-row">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer text-center">
                    <button id="btn-close-modal"
                            class="btn btn-danger col-xs-5 col-sm-5 col-md-3 col-lg-3">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Order detail -->
@stop
