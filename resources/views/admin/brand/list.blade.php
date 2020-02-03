@extends('admin.layout.index')
@section('title','Danh sách thương hiệu')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách thương hiệu
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
                            <table id="table" class="table-hover table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="40%">Tên thương hiệu</th>
                                    <th width="25%">Logo</th>
                                    <th width="15%">Trạng thái</th>
                                    <th width="15%">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                @foreach($brands as $brand)
                                    <tr id="brand{{ $brand->id }}">
                                        <td width="5%">{{$brand->id}}</td>
                                        <td width="40%">{{$brand->name}}</td>
                                        <td width="25%">
                                            <img src="{{asset('storage/app/brands/' . $brand->logo)}}" height="50px">
                                        </td>
                                        <td width="15%" class="status">
                                            @if($brand->deleted_at == null)
                                                Đang hoạt động
                                            @else
                                                Ngừng kinh doanh
                                            @endif
                                        </td>
                                        <td width="15%" class="function">
                                            <a href="{{ route('admin.brands.get_edit_brand', $brand->id)}}"
                                               class="btn btn-warning on @if($brand->deleted_at != null) hidden @endif"><i class="fas fa-edit"></i></a>
                                            <button data-url="{{ route('admin.brands.delete', $brand->id) }}"
                                                    data-id="{{ $brand->id }}"
                                                    class="btn btn-danger on btn-del-brand @if($brand->deleted_at != null) hidden @endif"><i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button data-url="{{route('admin.brands.restore', $brand->id)}}"
                                                    data-id="{{ $brand->id }}"
                                                    class="btn btn-primary off btn-restore-brand @if($brand->deleted_at == null) hidden @endif"><i class="fas fa-trash-restore"></i>
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
