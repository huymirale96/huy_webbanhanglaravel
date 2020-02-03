@extends('website.layout.index')
@section('title', $product->name)
@section('container')
    <link rel="stylesheet" href="css/product-detail.css">
    <!-- Single Page -->
    <div class="container">
        <div class="banner-bootom-w3-agileits py-5">
            <div class="product-sec1 container py-xl-4 py-lg-2">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-12 single-right-left ">
                        <div id="demo" class="product-sec1 carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img height="500px" class="d-block m-auto"
                                         src="{{ asset('storage/app/products/'.$product->image) }}"
                                         data-imagezoom="true">
                                </div>
                                @foreach ($product->product_image as $image)
                                    <div class="carousel-item">
                                        <img height="500px" class="d-block m-auto"
                                             src="{{ asset('storage/app/products/'.$image->image) }}"
                                             data-imagezoom="true">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-4 single-right-left simpleCart_shelfItem">
                        <h3 class="mb-3">{{ $product->name }}</h3>
                        <p class="mb-3">
                            <span id="p_price" class="item_price">{{ number_format($product->product_type[0]->promotion_price) }} đ</span>
                            <del id="s_price"
                                 class="mx-2 font-weight-light">{{ number_format($product->product_type[0]->stock_price) }}
                                đ
                            </del>
                        </p>
                        <div class="description-product" style="text-align: justify">
                            {!! $product->description !!}
                        </div>
                        <div class="product-single-w3l">
                            <p class="my-3">
                                <i class="far fa-hand-point-right mr-2"></i>
                                STARPHONE</p>
                            <ul id="list-style">
                                <li class="mb-1">
                                    <i class="far fa-registered"></i>&nbsp Hàng chính hãng
                                </li>
                                <li class="mb-1">
                                    <i class="far fa-clock"></i>&nbsp Bảo hành 12 tháng
                                </li>
                                <li class="mb-1">
                                    <i class="fas fa-shipping-fast"></i>&nbsp Giao hành nội thành Hà Nội trong 60
                                    phút
                                </li>
                                <li class="mb-1">
                                    <i class="fas fa-shield-alt"></i>&nbsp Trả góp lãi xuất 0%
                                </li>
                                <li class="mb-1">
                                    <i class="far fa-handshake"></i>&nbsp Trở thành khách hàng thân thiết của Star
                                    Phone
                                </li>
                            </ul>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6" id="type">
                                <select name="product_type" id="product_typeeee">
                                    @foreach($product->product_type as $item)
                                        <option data-s_price="{{ $item->stock_price }}"
                                                data-p_price="{{ $item->promotion_price }}"
                                                value="{{ $item->id }}">{{ $item->product_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div
                                class="col-md-6 snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                <button data-url="{{ route('cart.store') }}"
                                        data-id="{{ $product->id }}"
                                        data-product_type="{{ $product->product_type[0]->id }}"
                                        class="btn btn-danger btn-add-cart">Đặt mua
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="product-info" class="row">
            <!-- Product detail -->
            <div class="col-md-12 col-lg-9 col-sm-12">
                <link rel="stylesheet" href="../admin/css/tab-link.css">
                <div class="tab">
                    <button class="tablinks active" onclick="openTab(event, 'content')">Mô tả</button>
                    <button class="tablinks" onclick="openTab(event, 'option')">Thông số kỹ thuật</button>
                    <button class="tablinks" onclick="openTab(event, 'review')">Đánh giá, bình luận</button>
                </div>
                <div id="content" class="tabcontent">
                    {!! $product->content !!}
                </div>
                <div id="option" class="tabcontent">
                    <table class="table table-striped table-bordered table-hover">
                        <th colspan="2">THÔNG SỐ KỸ THUẬT</th>
                        @if (!empty($product->product_option))
                            @foreach($product->product_option as $option)
                                <tr style="font-size: 12px">
                                    <td width="20%">{{$option->option_name}}</td>
                                    <td width="80%">{{$option->option_value}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                <style>
                    #review {
                        max-height: 500px;
                        overflow-y: auto;
                    }
                </style>
                <div id="review" class="tabcontent">
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="845"
                         data-numposts="5">
                    </div>
                    @if (Auth::guard('customers')->check())
                        @if (isset($arr_customer_id) && isset($auth) && !in_array($auth, $arr_customer_id))
                            <div style="margin-top:40px;">
                                <div class="col-md-12" id="post-review-box">
                                    <input id="ratings-hidden" name="rating" type="hidden">
                                    <textarea class="form-control animated" cols="50" id="product-review"
                                              placeholder="Hãy để lại đánh giá của bạn"
                                              rows="4"></textarea>
                                    <div class="text-right">
                                        <div class="stars starrr" data-rating="0"></div>
                                        <button data-product_id="{{ $product->id }}" class="btn btn-success btn-rating">
                                            Gửi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @elseif (!isset($arr_customer_id))
                            <div style="margin-top:40px;">
                                <div class="col-md-12" id="post-review-box">
                                    <input id="ratings-hidden" name="rating" type="hidden">
                                    <textarea class="form-control animated" cols="50" id="product-review"
                                              placeholder="Hãy để lại đánh giá của bạn"
                                              rows="4"></textarea>
                                    <div class="text-right">
                                        <div class="stars starrr" data-rating="0"></div>
                                        <button data-product_id="{{ $product->id }}" class="btn btn-success btn-rating">
                                            Gửi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="page-header">
                            <h5>Hãy đăng nhập để có thể đánh giá !</h5>
                        </div>
                        <hr>
                    @endif
                    <div class="page-header">
                        <h4>
                            @if (count($comments) > 0)
                                <span>
                                {{ count($comments) }} đánh giá  -
                            </span>
                                <span>
                                {{ $ave_star }} <i class="fas fa-star"></i>
                            </span>
                            @else
                                Chưa có đánh giá !
                            @endif
                        </h4>
                    </div>
                    <hr>
                    <div class="new-comment"></div>
                    @foreach($comments as $comment)
                        <div class="comments-list">
                            <div class="media">
                                <a class="media-left col-md-1" href="#">
                                    <img src="http://lorempixel.com/40/40/people/1/">
                                </a>
                                <div class="media-body col-md-10">
                                    <h4 class="media-heading user_name col-md-8">
                                        {{ $comment->name }}
                                        (<small> {{ date('d/m/Y - H:i:s', strtotime($comment->created_at)) }}</small>)
                                        - {{ $comment->star }} <i class="fas fa-star"></i>
                                    </h4>
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <!-- /Product detail -->
            </div>
            <!-- Right content -->
            <div id="right-content" class="col-lg-3 col-md-4">
                <div class="side-bar p-sm-4 p-3">
                    <!-- product relate-->
                    <div class="f-grid py-2">
                        <h3 class="agileits-sear-head mb-3">Sản phẩm liên quan</h3>
                        @if (!empty($product_relates))
                            @foreach ($product_relates as $product)
                                <div class="row right-product">
                                    <div class="col-lg-3 col-sm-2 col-4 left-mar">
                                        <img src="{{ asset('storage/app/products/'.$product->image) }}" alt=""
                                             class="img-fluid">
                                    </div>
                                    <div class="col-lg-9 col-sm-10 col-8 w3_mvd">
                                        <a href="{{ route('product.detail', ['dien-thoai', $product->slug]) }}">{{ $product->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <hr>
                    <div class="range border-bottom py-2">
                        <h3 class="agileits-sear-head mb-3">Phụ kiện hay được mua kèm</h3>
                        @if (!empty($accessories))
                            @foreach ($accessories as $product)
                                <div class="row right-product">
                                    <div class="col-lg-3 col-sm-2 col-4 left-mar">
                                        <img src="{{ asset('storage/app/products/'.$product->image) }}" alt=""
                                             class="img-fluid">
                                    </div>
                                    <div class="col-lg-9 col-sm-10 col-8 w3_mvd">
                                        <a href="{{ route('product.detail', ['phu-kien', $product->slug]) }}">{{ $product->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- /product relate -->
                </div>
                <!-- //product right -->
            </div>
            <!-- /Right content -->
        </div>
        <!-- //Single Page -->
        <script src="../admin/js/scripts.js"></script>
    </div>
@stop
