<!DOCTYPE html>
<html lang="vi">
<head>
    <title>@yield('title')</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <meta property="fb:app_id" content="2441440862629884"/>
    <meta property="fb:admins" content="1526551657651749"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <base href="{{asset('public/asset/website/')}}/">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="css/style-css.css">
    <link rel="stylesheet" href="css/tab-link.css">
    <link rel="stylesheet" href="/css/bootstrap-rating.min.css">
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="css/jquery.toast.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <link
        href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext"
        rel="stylesheet">
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
</head>
<body>
<!-- top-header -->
<div class="agile-main-top">
    <div class="container-fluid">
        <div class="row main-top-w3l py-2">
            <div class="col-lg-2 col-md-3 p-r-0 header-most-top">
                <p class="text-white text-lg-left text-center">buivansao.tech
                </p>
            </div>
            <div class="col-lg-10 col-md-9 p-0 header-right mt-lg-0">
                <!-- header lists -->
                <ul class="row float-md-right-r">
                    <li class="col-md-2 d-none d-sm-block d-md-block text-center text-white li1">
                        <a class="text-white" href="tel:0363071298"><i class="fas fa-phone mr-2"></i>0360.07.12.98</a>
                    </li>
                    <li class="col-md-3 d-none d-sm-block d-md-block text-center text-white p-0 li1">
                        <a class="text-white" href="mailto:buivansaobg@gmail.com"><i class="far fa-paper-plane"></i>
                            buivansaobg@gmail.com</a>
                    </li>
                    <li class="col-md-2 d-none d-sm-block d-md-block text-center text-white li1">
                        <a class="text-white" target="_blank"
                           href="https://www.google.com/maps/place/Faculty+of+Information+Technology/@20.9851122,105.8365452,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ac5d6ec1b8cf:0x982365cd4337fdc8!8m2!3d20.9851122!4d105.8387339"><i
                                class="fas fa-map-marker-alt"></i> 96 Định Công - HN</a>
                    </li>
                    <div id="track" class="p-r-0 col col-md-2">
                        @if (Auth::guard('customers')->check())
                            <li class="text-center text-white w-100">
                                <a class="text-white"
                                   href="{{ route('customer.history.order') }}">
                                    <i class="fas fa-truck"></i> Đơn hàng</a>
                            </li>
                        @endif
                    </div>
                    <li id="li-login" class="col col-sm-4 col-md-2 p-0 text-center text-white">
                        @if (Auth::guard('customers')->check())
                            <button
                                data-toggle="modal" data-target="#modal-profile"
                                data-url="{{ route('cart.user_info') }}"
                                class="text-white btn" id="s-login">
                                <i class="far fa-user mr-2"></i> {{ Auth::guard('customers')->user()->name }}
                            </button>
                        @else
                            <button id="a-login"
                                    class="text-white btn">
                                <i class="fas fa-sign-in-alt mr-2"></i>Đăng nhập
                            </button>
                        @endif
                    </li>
                    <li id="li-logout" class="col col-sm-3 col-md-1  p-0 text-center text-white">
                        @if (!Auth::guard('customers')->check())
                            <button id="a-signup" style="background-color: transparent; border: none; font-size: 13px;"
                                    class="text-white btn"><i class="fas fa-sign-out-alt mr-2"></i>Đăng ký
                            </button>
                        @else
                            <button id="btn-logout"
                                    class="text-white btn" data-url="{{ route('customer.logout') }}"><i
                                    class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
                            </button>
                        @endif
                    </li>
                </ul>
                <!-- //header lists -->
            </div>
        </div>
    </div>
</div>

<!-- modals -->
<!-- log in/resgister -->
@include('website.auth.auth')
<!-- cart -->
@include('website.cart.cart')
<!-- //modal -->
<!-- //top-header -->

<!-- header-bottom-->
<div class="header-bot">
    <div class="container">
        <div class="row header-bot_inner_wthreeinfo_header_mid">
            <!-- logo -->
            <div class="col-md-3 logo_agile">
                <h1 class="text-center">
                    <a href="{{ url('/') }}" class="font-weight-bold">
                        <img width="110px" src="{{ asset('storage/app/upload/logo-website.svg.png') }}" class="img-fluid">
                        <span style="margin-left: 50px"> STAR</span>
                    </a>
                </h1>
            </div>
            <!-- //logo -->
            <!-- header-bot -->
            <div class="col-md-9 header mt-4 mb-md-0 mb-4">
                <div class="row">
                    <!-- search -->
                    <div class="col-10 agileits_search">
                        <form class="form-inline" action="{{ route('search_product') }}" method="get">
                            <input name="key" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm..."
                                   aria-label="Search">
                            <button class="btn my-2 my-sm-0" type="submit">OK</button>
                        </form>
                    </div>
                    <!-- //search -->
                    <!-- cart details -->
                    <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
                        <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                            <button data-toggle="modal" data-target="#modal-order" class="btn w3view-cart"
                                    id="btn-show-cart" data-url="{{ route('cart.index') }}">
                                <i class="fas fa-cart-arrow-down"></i>
                            </button>
                        </div>
                    </div>
                    <!-- //cart details -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shop locator (popup) -->
<!-- //header-bottom -->
<!-- navigation -->
<div class="navbar-inner">
    <div class="container-fluid">
        <nav class="navbar-expand-lg navbar-ligh">
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @foreach ($view_categories as $key => $item)
                        <li class="nav-item mr-lg-5 mb-lg-0 mb-3">
                            <a class="nav-link" href="{{ route('category', $item->slug) }}">{!! $item->icon !!} </br>
                                <span>{{ $item->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- //navigation -->
