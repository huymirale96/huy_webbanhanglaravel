@extends('admin.layout.index')
@section('title','Danh sách tin tức')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Danh sách tin tức
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
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Tên tin tức</th>
                                    <th>Ngày đăng</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listNews as $item)
                                    <tr id="new{{ $item->id }}">
                                        <td>{{$item->id}}</td>
                                        <td>
                                            <img src="{{asset('storage/app/news/' . $item->image)}}" height="100px">
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{ date('d/m/Y - H:i:s', strtotime($item->created_at)) }}</td>
                                        <td class="status">
                                            @if($item->deleted_at == null)
                                                Hiện
                                            @else
                                                Ẩn
                                            @endif
                                        </td>
                                        <td class="function">
                                            <a href="{{ route('admin.news.get_edit_new', $item->id )}}"
                                               class="btn btn-warning on @if($item->deleted_at != null) hidden @endif"><i class="fas fa-edit"></i></a>
                                            <button data-url="{{ route('admin.news.delete', $item->id) }}"
                                                    data-id="{{ $item->id }}"
                                                    class="btn btn-danger on btn-delete-new @if($item->deleted_at != null) hidden @endif"><i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button data-url="{{ route('admin.news.restore', $item->id) }}"
                                                    data-id="{{ $item->id }}"
                                                    class="btn btn-primary off btn-restore-new @if($item->deleted_at == null) hidden @endif"><i class="fas fa-trash-restore"></i>
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
