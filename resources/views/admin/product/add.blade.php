@extends('admin.layout.index')
@section('title','Thêm sản phẩm')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thêm mới sản phẩm
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
                                  action="{{ route('admin.products.post_add_product') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12">
                                            <label>Tên sản phẩm</label>
                                            <input required type="text" name="name" value="{{ old('name') }}"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Thương hiệu</label>
                                            <select class="selectpicker form-control" data-live-search="true"
                                                    name="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Danh mục</label>
                                            <select class="selectpicker form-control" multiple
                                                    data-live-search="true"
                                                    name="category[]">
                                                @foreach ($categories as $key => $item)
                                                    <option value="{{ $item->id }}">{{ $key }}
                                                        . {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Sản phẩm liên quan</label>
                                            <select name="relate[]" multiple class="form-control selectpicker"
                                                    multiple
                                                    data-live-search="true">
                                                @foreach ($products as $key => $item)
                                                    <option value="{{ $item->id }}">{{ $key }}
                                                        . {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Hình đại diện</label>
                                        <div id="previewImage">
                                            <img
                                                src="http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg">
                                        </div>
                                        <input id="image" onchange="previewImage()" style="visibility:hidden;"
                                               type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Ảnh chi tiết sản phẩm</label>
                                    <div id="previewImageDetail"></div>
                                    <label for="images" class="btn btn-primary"> Tải lên
                                    </label>
                                    <input id="images" onchange="previewImageDetail()" name="images[]" multiple
                                           style="visibility:hidden;" type="file">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Mô tả ngắn</label>
                                    <textarea placeholder="Nên nhập tối đa 5 dòng" id="editor_short" name="description"
                                              class="ckeditor">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label>Chi tiết sản phẩm</label>
                                    <textarea id="editor" name="content"
                                              class="ckeditor">{{ old('content') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <table id="myTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="45%">Thuộc tính</th>
                                            <th width="50%">Giá trị</th>
                                        </tr>
                                        </thead>
                                        <tbody id="options">
                                        <tr>
                                            <td width="45%">
                                                <input type="text" name="option_name[]" class="form-control"/>
                                            </td>
                                            <td width="50%">
                                                <input type="text" name="option_value[]" class="form-control"/>
                                            </td>
                                            <td class="col-sm-2"><a class="deleteRow"></a></td>
                                        </tr>
                                        </tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right">
                                                <a class="btn btn-success" style="width: 40px"
                                                   id="add-option"><i class="fas fa-plus-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <table id="myTable" class="table order-list">
                                        <thead>
                                        <tr>
                                            <th>Phiên bản</th>
                                            <th>Giá gốc</th>
                                            <th>Giá bán</th>
                                            <th>Kho hàng</th>
                                        </tr>
                                        </thead>
                                        <tbody id="types">
                                                <tr id="type{{ $item->id }}">
                                                    <td class="col-md-4 col-lg-5">
                                                        <input required type="text" name="product_type_name[]"
                                                               value="{{ $item->type_value }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-2 col-lg-2">
                                                        <input required type="number" name="product_type_stock_price[]"
                                                               value="{{ $item->stock_price }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-2 col-lg-2">
                                                        <input required type="number" name="product_type_promotion_price[]"
                                                               value="{{ $item->promotion_price }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-2 col-lg-2">
                                                        <input required type="number" name="product_type_stock[]"
                                                               value="{{ $item->stock }}"
                                                               class="form-control"/>
                                                    </td>
                                                </tr>
                                        </tbody>
                                        <tr>
                                            <td colspan="4" style="text-align: right">
                                                <a class="btn btn-success" style="width: 40px"
                                                   id="add-type">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group text-center">
                                    <input type="submit" name="submit"
                                           class="btn btn-danger col-xs-12 col-sm-12 col-md-12 col-lg-12" value="Thêm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop

