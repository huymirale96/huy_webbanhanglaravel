@extends('admin.layout.index')
@section('title','Thêm tin khuyến mãi')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm mới tin khuyến mãi
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
                            <form action="{{ route('admin.banners.post_add_banner') }}" method="POST"
                                  accept-charset="utf-8"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label>Tiêu đề</label>
                                    <input value="" type="text" name="name"
                                           class="form-control col-md-12">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Hình đại diện</label>
                                    <div id="previewBannerImage">
                                        <img
                                            src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg">
                                    </div>
                                    <input id="image" onchange="previewImage()" style="visibility:hidden;"
                                           type="file" name="image">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Nội dung</label>
                                    <textarea id="editor" name="content"
                                              class="ckeditor col-xs-12 col-sm-12 col-md-12 col-lg-12"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Thêm"
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
