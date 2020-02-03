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
                            <form method="POST" accept-charset="utf-8" enctype="multipart/form-data"
                                  action="{{ route('admin.brands.post_edit_brand', $id) }}">
                                @csrf
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Tên thương hiệu</label>
                                    <input type="text" name="name" class="form-control" placeholder="Tên danh mục..."
                                           value="{{$name}}">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Logo</label>
                                    <label class="btn btn-success" for="upload">Tải ảnh lên</label>
                                    <input id="upload" type="file" style="visibility: hidden" onchange="preview()"
                                           name="logo"
                                           class="form-control">
                                    <img id="img" src="{{asset('storage/app/brands/' . $logo)}}"
                                         height="120px">
                                </div>

                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Giới thiệu về thương hiệu</label>
                                    <textarea id="editor" name="description"
                                              class="ckeditor">{{$description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Cập nhật"
                                           class="btn btn-danger col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
