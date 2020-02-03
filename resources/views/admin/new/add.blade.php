@extends('admin.layout.index')
@section('title','Thêm tin tức')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm mới tin tức
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
                            <form action="{{ route('admin.news.post_add_new') }}" method="POST" accept-charset="utf-8"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label>Tiêu đề</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Tóm tắt nội dung</label>
                                            <textarea type="text" name="description" rows="5"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Ảnh bìa</label>
                                        <style>
                                            #previewImage {
                                                cursor: pointer;
                                            }

                                            #previewImage > img {
                                                max-width: 100%;
                                                max-height: 190px;
                                            }
                                        </style>
                                        <div id="previewImage">
                                            <img
                                                src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg">
                                        </div>
                                        <input id="image" onchange="previewImage()" style="visibility:hidden;"
                                               type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-lg-12 col-md-12">
                                    <label>Nội dung</label>
                                    <textarea id="editor" name="content" class="ckeditor"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" value="Thêm mới" class="btn btn-primary ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
