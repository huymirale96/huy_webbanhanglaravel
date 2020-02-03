@extends('admin.layout.index')
@section('title','Danh mục quảng cáo')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách tin khuyến mãi
            </h1>
        </section>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
    @endif
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="40%">Tên danh mục</th>
                                    <th width="25%">Ảnh banner</th>
                                    <th width="15%">Trạng thái</th>
                                    <th width="15%">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                @foreach($banners as $banner)
                                    <tr id="banner{{ $banner->id }}">
                                        <td width="5%">{{$banner->id}}</td>
                                        <td width="40%">{{$banner->name}}</td>
                                        <td width="25%">
                                            <img src="{{asset('storage/app/banners/' . $banner->image)}}"
                                                 height="100px">
                                        </td>
                                        <td width="15%" class="status">
                                            @if($banner->deleted_at == null)
                                                Hiển thị
                                            @else
                                                Ẩn
                                            @endif
                                        </td>
                                        <td width="15%" class="function">
                                            <a href="{{ route('admin.banners.get_edit_banner', $banner->id)}}"
                                               class="btn btn-warning on @if($banner->deleted_at != null) hidden @endif"><i class="fas fa-edit"></i></a></a>
                                            <button data-url="{{ route('admin.banners.delete', $banner->id) }}"
                                                    data-id="{{ $banner->id }}"
                                                    class="btn btn-danger on btn-del-banner @if($banner->deleted_at != null) hidden @endif"><i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button data-url="{{route('admin.banners.restore', $banner->id)}}"
                                                    data-id="{{ $banner->id }}"
                                                    class="btn btn-primary off btn-restore-banner @if($banner->deleted_at == null) hidden @endif"><i class="fas fa-trash-restore"></i>
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
    </div>
@stop
