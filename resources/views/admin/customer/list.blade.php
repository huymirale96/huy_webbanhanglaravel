@extends('admin.layout.index')
@section('title','Danh sách khách hàng')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách khách hàng
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listCustomers as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>@if ($item->deleted_at == null) Hoạt động @else Không hoạt động @endif</td>
                                        <td>
                                            <button data-toggle="modal" data-target="#modal-customer"
                                                    data-url="{{ route('admin.customers.profile', $item->id) }}"
                                                    class="btn-customer-profile btn btn-info"><i
                                                    class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id="modal-customer" class="modal fade" aria-hidden="true" role="dialog" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">THÔNG TIN KHÁCH HÀNG</span>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label>Họ tên: </label><span id="name"></span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label>Email: </label><span id="email"></span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label>Điện thoại: </label><span id="phone"></span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label>Địa chỉ: </label><span id="address"></span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label>Số nhà, ngách, ngõ: </label><span
                                                    id="detail"></span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label>Ngày đăng ký: </label><span
                                                    id="created_at"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btn-close-modal"
                                                class="btn btn-danger col-xs-5 col-sm-5 col-md-3 col-lg-3">
                                            Đóng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
