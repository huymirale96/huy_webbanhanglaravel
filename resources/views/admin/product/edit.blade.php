@extends('admin.layout.index')
@section('title', $product->name)
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $product->name }}
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
                            <div class="tab">
                                <button class="tablinks active" onclick="openTab(event, 'product')">Thông tin chung
                                </button>
                                <button class="tablinks" onclick="openTab(event, 'option')">Thông số kỹ thuật</button>
                                <button class="tablinks" onclick="openTab(event, 'type')">Phiên bản</button>
                                <button class="tablinks" onclick="openTab(event, 'image')">Ảnh</button>
                            </div>

                            <form method="post" enctype="multipart/form-data"
                                  action="{{ route('admin.products.post_edit_product', $product->id) }}">
                                @csrf
                                <div id="product" style="display: block" class="tabcontent">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group col-md-12">
                                                <label>Tên sản phẩm</label>
                                                <input required type="text" name="name" class="form-control"
                                                       value="{{$product->name}}">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Thương hiệu</label>
                                                <select name="brand_id" class="selectpicker form-control"
                                                        data-live-search="true">
                                                    @foreach($listBrands as $brand)
                                                        <option
                                                            @if($product->brand_id == $brand->id)
                                                            selected
                                                            @endif
                                                            value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Danh mục</label>
                                                <select class="selectpicker form-control" multiple
                                                        data-live-search="true"
                                                        name="category[]">
                                                    @foreach ($listCategories as $item)
                                                        <option value="{{ $item->id}}"
                                                                @if (!empty($product_category))
                                                                @foreach ($product_category as $cate)
                                                                @if ($cate->id == $item->id) selected @endif
                                                            @endforeach
                                                            @endif
                                                        > {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Sản phẩm liên quan</label>
                                                <select name="relate[]" class="selectpicker form-control" multiple
                                                        data-live-search="true">
                                                    @foreach ($listProducts as $item) {
                                                    <option value="{{ $item->id }}"
                                                            @if (!empty($product_relate))
                                                            @foreach ($product_relate as $relate)
                                                            @if ($relate->product_relate_id == $item->id) selected @endif
                                                        @endforeach
                                                        @endif
                                                    > {{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Ảnh đại diện</label>
                                            <div class="edit-image">
                                                <img src="{{ asset('storage/app/products/' . $product->image) }}">
                                                <label for="edit-image" class="edit-image-button btn btn-primary"><i
                                                        class="fas fa-edit"></i> Thay đổi</label>
                                            </div>
                                            <input id="edit-image" type="file" style="visibility: hidden"
                                                   onchange="previewEditImage()" name="image">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <label>Mô tả ngắn</label>
                                        <textarea placeholder="Nên nhập tối đa 5 dòng" id="editor_short"
                                                  name="description"
                                                  class="ckeditor">{{$product->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung chi tiết</label>
                                        <textarea id="editor" name="content"
                                                  class="ckeditor">{{$product->content}}</textarea>
                                    </div>
                                </div>

                                <div id="option" class="tabcontent">
                                    <table id="myTable" class="table order-list">
                                        <thead>
                                        <tr>
                                            <th>Thuộc tính</th>
                                            <th>Giá trị</th>
                                        </tr>
                                        </thead>
                                        <tbody id="options">
                                        @if(empty($product_option)) {{"Chưa có thông tin"}}
                                        @else
                                            @foreach($product_option as $key => $option)
                                                <tr id="option{{ $option->id }}">
                                                    <td class="col-md-5 col-lg-5">
                                                        <input type="text" name="option_name[{{ $key }}]"
                                                               value="{{$option->option_name}}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-5 col-lg-5">
                                                        <input type="text" name="option_value[{{ $key }}]"
                                                               value="{{$option->option_value}}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-sm-2">
                                                        <button data-id="{{$option->id}}"
                                                                data-url="{{ route('admin.products.delete_option', $option->id) }}"
                                                                class="btn btn-danger btn-del-option">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tr>
                                            <td colspan="2" style="text-align: right">
                                                <a class="btn btn-success" style="width: 40px"
                                                   id="add-option">
                                                    <i class="fas fa-plus-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div id="type" class="tabcontent">
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
                                        @if(empty($product_type)) {{"Chưa có thông tin"}}
                                        @else
                                            @foreach($product_type as $key => $item)
                                                <tr id="type{{ $item->id }}">
                                                    <td class="col-md-4 col-lg-5">
                                                        <input required type="text" name="product_type_name[{{ $key }}]"
                                                               value="{{ $item->type_value }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-2 col-lg-2">
                                                        <input required type="number" name="product_type_stock_price[{{ $key }}]"
                                                               value="{{ $item->stock_price }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-2 col-lg-2">
                                                        <input required type="number" name="product_type_promotion_price[{{ $key }}]"
                                                               value="{{ $item->promotion_price }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-md-2 col-lg-2">
                                                        <input required type="number" name="product_type_stock[{{ $key }}]"
                                                               value="{{ $item->stock }}"
                                                               class="form-control"/>
                                                    </td>
                                                    <td class="col-sm-2">
                                                        <button data-id="{{$item->id}}"
                                                                data-url="{{ route('admin.products.delete_option', $item->id) }}"
                                                                class="btn btn-danger btn-del-type">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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

                                <div id="image" class="tabcontent">
                                    @foreach ($listImages as $img)
                                        <div class="profile-pic" id="img{{ $img->id }}">
                                            <img src="{{asset('storage/app/products/' . $img->image)}}"
                                                 height="300px">
                                            <div class="edit">
                                                <button class="btn-del-img btn btn-danger" data-id="{{ $img->id }}"
                                                        data-url="{{route('admin.products.delete_image', $img->id)}}">
                                                    <i class="fas fa-trash-alt" id="icon-delete-image"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div id="previewImageDetail"></div>
                                    <div style="margin-top: 10px">
                                        <label for="images" class="btn btn-success">Thêm ảnh</label>
                                        <input id="images" name="images[]" multiple style="visibility:hidden;"
                                               type="file">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                            class="btn btn-danger col-xs-12 col-sm-12 col-md-12 col-lg-12 font-weight-bold">
                                        Cập nhật
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
        </section>
    </div>    <!--/.main-->
@stop
