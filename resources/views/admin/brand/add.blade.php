@extends('admin.layout.index')
@section('title','Thêm thương hiệu')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm mới thương hiệu
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
                            <form action="{{ route('admin.brands.post_add_brand') }}" method="POST"
                                  accept-charset="utf-8"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Tên thương hiệu</label>
                                    <input required value="{{ old('name') }}" type="text" name="name"
                                           class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-12   ">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Logo</label>
                                    <label for="avatar" class="btn btn-success">Tải ảnh lên</label>
                                    <input style="visibility: hidden;" id="avatar" type="file" onchange="preview_ava()"
                                           name="logo"
                                           class="form-control">
                                    <div id="preview"></div>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Giới thiệu</label>
                                    <textarea id="editor" name="description"
                                              class="ckeditor col-xs-12 col-sm-12 col-md-12 col-lg-12">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Thêm mới"
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
