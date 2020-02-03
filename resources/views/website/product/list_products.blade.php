@extends('website.layout.index')
@section('title', $category->name)
@section('container')
    <!-- top Products -->
    <div class="ads-grid py-sm-5 py-6">
        <div class="container py-xl-4 py-lg-2">
            <div class="row">
                <!-- Left Content -->
            @include('website.product.filter')
            <!-- /Left Content -->

                <!-- product right -->
                <div class="agileinfo-ads-display col-lg-10">
                    <div class="wrapper">
                        <!-- first section -->
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                            <h3 class="heading-tittle text-center font-italic">{{ $category->name }}</h3>
                            <div class="row">
                                @php ([$sub_price = 0, $stock_price = 0, $promotion_price = 0, $star = 5, $comments = 0])
                                @foreach ($products as $product)
                                    @php ([
                                            $sub_price = $product->product_type[0]->stock_price - $product->product_type[0]->promotion_price,
                                            $stock_price = $product->product_type[0]->stock_price,
                                            $promotion_price = $product->product_type[0]->promotion_price,
                                            $star = isset($product->product_review[0]) ? round($product->product_review[0]->ave_star) : 5,
                                            $comments = isset($product->product_review[0]) ? $product->product_review[0]->comments . ' ' : '0 ',
                                    ])
                                    <div class="col-md-3 product-men">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img height="195px"
                                                     src="{{ asset('storage/app/products/'. $product->image) }}" alt="">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="{{ route('product.detail', [$category->slug, $product->slug]) }}"
                                                           class="link-product-add-cart">Chi tiết</a>
                                                    </div>
                                                </div>
                                                @if ($sub_price >= 10000)
                                                    <span class="product-new-top">
                                                    <del>Giảm: {{ number_format($sub_price) }}<sup>đ</sup></del>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4>
                                                    <a href="{{ route('product.detail', [$category->slug, $product->image]) }}">{{ $product->name }}</a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span
                                                        class="item_price">{{ number_format($promotion_price) }}<sup>đ</sup></span>
                                                    @if ($sub_price >= 10000)
                                                        <del>{{ number_format($stock_price) }}<sup>đ</sup></del>
                                                    @endif
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="product-rating">
                                                    <div class="stars starrr"
                                                         data-rating="{{ $star }}">
                                                    </div>
                                                    <span>{{ $comments }}đánh giá</span>
                                                </div>
                                                <div
                                                    class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <button data-url="{{ route('cart.store') }}"
                                                            data-id="{{ $product->id }}"
                                                            data-type_id="{{ $product->product_type[0]->id }}"
                                                            class="btn btn-info btn-add-cart">Đặt mua
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- //first section -->
                    </div>
                    <div class="pagination">
                        {!! $products->links() !!}
                    </div>
                </div>
                <!-- /product right -->
            </div>
        </div>

    </div>
    <!-- //top products -->
@stop
