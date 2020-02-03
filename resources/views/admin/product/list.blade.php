@extends('admin.layout.index')
@section('title','Danh sách sản phẩm')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách sản phẩm
            </h1>
        </section>
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong id="alert">{{ $message }}</strong>
                                </div>
                            @endif
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Hình</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Thương hiệu</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody id="list-product">
                                @foreach($products as $product)
                                    <tr id="product{{ $product->id }}">
                                        <td width="3%">{{$product->id}}</td>
                                        <td width="8%">
                                            <img src="{{asset('storage/app/products/' . $product->image)}}"
                                                 height="100px">
                                        </td>
                                        <td width="30%">{{$product->name}}</td>
                                        <td width="13%">{{$product->brand->name}}</td>
                                        <td>{{ date('d/m/Y - H:i:s'), strtotime($product->created_at) }}</td>
                                        <td class="status" with="13%">
                                            @if($product->deleted_at == null)
                                                Đang bán
                                            @else
                                                Ngừng kinh doanh
                                            @endif
                                        </td>
                                        <td class="function" width="10%">
                                            <a href="{{ route('admin.products.get_edit_product', $product) }}"
                                               class="btn btn-warning on @if($product->deleted_at != null) hidden @endif">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button data-id="{{ $product->id }}"
                                                    data-url="{{ route('admin.products.delete', $product)}}"
                                                    class="btn btn-danger btn-del-product on @if($product->deleted_at != null) hidden @endif">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button data-url="{{ route('admin.products.restore', $product)}}"
                                                    data-id="{{ $product->id }}"
                                                    class="btn btn-primary btn-restore-product off @if($product->deleted_at == null) hidden @endif">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!--/.row-->
@stop
