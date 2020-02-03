@extends('admin.layout.index')
@section('title', $name)
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $name }}
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.news.post_edit_new', $id) }}" method="POST"
                                  accept-charset="utf-8"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label>Tên tin tức</label>
                                            <input type="text" name="name" value="{{ $name }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Tóm tắt nội dung</label>
                                            <textarea name="description" rows="5"
                                                      class="form-control">{{ $description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Ảnh đại diện</label>
                                        <div class="edit-image">
                                            <img src="{{ asset('storage/app/news/' . $image) }}">
                                            <label for="edit-image" class="edit-image-button btn btn-primary"><i
                                                    class="fas fa-edit"></i> Thay đổi</label>
                                        </div>
                                        <input id="edit-image" type="file" style="visibility: hidden"
                                               onchange="previewEditImage()" name="image">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Nội dung</label>
                                    <textarea id="editor" name="content" class="ckeditor">{{ $content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Cập nhật"
                                           class="btn btn-primary col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
