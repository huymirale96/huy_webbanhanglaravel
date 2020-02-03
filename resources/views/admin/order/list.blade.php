@extends('admin.layout.index')
@section('title','Danh sách đơn hàng')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <link rel="stylesheet" href="css/print-order.css">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách đơn hàng
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Khách hàng</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiết</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listOrders as $item)
                                    <tr id="row{{ $item->id }}">
                                        <td class="id">{{$item->order_id}}</td>
                                        <td class="name">{{$item->customer->name}}</td>
                                        <td class="phone">{{$item->customer->phone}}</td>
                                        <td class="email">{{$item->customer->email}}</td>
                                        <td class="address">{{ $item->address . ', ' . $item->ward->name . ', ' . $item->ward->district->name . ', ' . $item->ward->district->province->name}}</td>
                                        <td class="date">{{date('d/m/Y - H:i:s', strtotime($item->created_at))}}</td>
                                        <td class="status">
                                            @switch($item->status)
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
                                            <button data-note="{{ $item->note }}" data-id="{{ $item->id }}"
                                                    data-status="{{ $item->status }}"
                                                    data-url="{{ route('admin.orders.detail', $item->id) }}"
                                                    class="btn btn-success btn-order-detail"><i
                                                    class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="modal-order" class="modal fade" aria-hidden="true" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span id="bill" class="col-xs-6 col-sm-6 col-md-4 col-lg-4">HÓA ĐƠN SỐ</span>
                                        </br>
                                        <span id="created-at" class="col-xs-6 col-sm-6 col-md-4 col-lg-4"></span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-4 form-group">
                                            <label>Khách hàng: </label>
                                            <span id="customer-name"></span>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Email: </label>
                                            <span id="customer-email"></span>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Điện thoại: </label>
                                            <span id="customer-phone"></span>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <label>Địa chỉ: </label>
                                            <span id="address"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Trạng thái</label>
                                            <select id="select" class="selectpicker form-control" name="status">
                                                <option id="op0" value="0">Chờ xác nhận</option>
                                                <option id="op1" value="1">Đã xác nhận</option>
                                                <option id="op2" value="2">Đang giao hàng</option>
                                                <option id="op3" value="3">Đã giao hàng</option>
                                                <option id="op4" value="4">Đã hủy</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <label>Ghi chú: </label>
                                            <input class="form-control" id="note">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Trạng thái thanh toán: </label><span id="pay_status"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Phương thức thanh toán: </label><span id="payment_method"></span>
                                        </div>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr class="bg-primary">
                                                <th>Ảnh</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Giá bán</th>
                                                <th>Số lượng</th>
                                                <th>Tổng tiền (vnđ)</th>
                                            </tr>
                                            </thead>
                                            <tbody class="new-row-detail">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btn-update-order"
                                                class="btn btn-success col-md-3">
                                            Cập nhật
                                        </button>
                                        <button id="btn-print-order" class="btn btn-warning col-md-3">In hóa đơn
                                        </button>
                                        <button id="btn-close-modal"
                                                class="btn btn-danger col-md-3">
                                            Đóng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bill print -->
            <div id="bill-print">
                <div class="bill-header">
                    <div class="bill-left-header">
                        <h3>STAR MOBILE</h3>
                        <p><b>Địa chỉ: </b>Số 461 Nguyễn Khang, Yên Hòa,<br> Cầu Giấy, Hà Nội <br>
                            <b>Điện thoại: </b>0363.07.12.98 - 0589.07.12.98 <br>
                            <b>Email: </b>buivansaobg@gmail.com <br>
                            <b>Website: </b>buivansao.tech</p>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="bill-right-header">
                        <h3>HÓA ĐƠN BÁN HÀNG</h3>
                        <p>--------------------***--------------------</p>
                        <p><span id="bill-id-print"></span></p>
                        <p><span id="created-at-print"></span></p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="bill-body">
                    <div class="customer-info">
                        <p>
                            <b>Họ tên khách hàng: </b>
                            <span id="customer-name-print"></span>
                            <b style="margin-left: 150px">Điện thoại: </b>
                            <span id="customer-phone-print"></span>
                        </p>
                        <p>
                            <b>Địa chỉ:</b>
                            <span id="address-print"></span>
                        </p>
                    </div>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td>STT</td>
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Giá bán</td>
                                <td>Thành tiền</td>
                            </tr>
                            </thead>
                            <tbody class="new-row-print">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="bill-footer">
                    <div class="bill-left-footer">
                        <br><br>
                        <p>Người mua hàng <br>
                            <span class="signature">(Ký, ghi rõ họ tên)</span>
                        </p>
                    </div>
                    <div class="bill-right-footer">
                        <p>Ngày {{ date("d") }}, tháng {{ date("m") }}, năm {{ date("Y") }}</p>
                        <p>Người bán hàng <br>
                            <span class="signature">(Ký, ghi rõ họ tên)</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Bill print -->
        </section>
    </div><!--/.row-->
@stop
