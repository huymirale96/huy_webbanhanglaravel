@extends('admin.layout.index')
@section('title','Danh mục sản phẩm')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh mục sản phẩm
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-7">
                    <div class="box">
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="30%">Tên danh mục</th>
                                    <th width="20%">Icon</th>
                                    <th width="20%">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $item)
                                    <tr id="cate{{ $item->id }}">
                                        <td>{{ $item->id }}</td>
                                        <td class="cate_name">{{ $item->name }}</td>
                                        <td class="cate_icon">{!! $item->icon !!}</td>
                                        <td>
                                            <button data-target="#box-edit" data-toggle="modal"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                    data-icon="{{ $item->icon }}"
                                                    class="btn btn-warning btn-edit-cate"><i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="box-edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">SỬA THÔNG TIN DANH MỤC</div>
                                    <div class="modal-body">
                                        <div class="form-group"><label>Tên danh mục</label>
                                            <input type="hidden" name="id" id="id">
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label>Icon</label><br><span id="icon"></span>
                                            <input type="text" class="form-control" id="icon-string" name="icon">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit"
                                                class="btn btn-success btn-submit-edit-cate col-xs-5 col-sm-5 col-md-8 col-lg-8">
                                            Cập nhật
                                        </button>
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
