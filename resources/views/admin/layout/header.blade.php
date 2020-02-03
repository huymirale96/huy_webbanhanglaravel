<!DOCTYPE html>
<html lang="vi">
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('public/asset/admin')}}/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/tab-link.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/jquery.toast.min.css">
    <link rel="stylesheet" href="css/preview-image.css">
    <link rel="stylesheet" href="css/delete-image.css">
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        #table th {
            white-space: nowrap;
            text-overflow: clip;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('admin.home') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>STAR</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="fa fa-align-justify"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if (Auth::user()->avatar !== null)
                                <img src="{{ asset('storage/app/users/' . Auth::user()->avatar) }}" class="user-image">
                            @else <img src="{{ asset('storage/app/users/user-default.png') }}" class="user-image">
                            @endif
                            <span class="hidden-xs">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if (Auth::user()->avatar !== null)
                                    <img src="{{ asset('storage/app/users/' . Auth::user()->avatar) }}"
                                         class="img-circle">
                                @else <img src="{{ asset('storage/app/users/user-default.png') }}" class="img-circle">
                                @endif
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Thành viên
                                        từ {{ date('d/m/Y', strtotime(Auth::user()->created_at)) }}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Trang cá
                                        nhân</a>
                                </div>
                                <div class="pull-right">
                                    <a id="logout" class="btn btn-default btn-flat" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                        Đăng xuất</a>
                                    <form id="frm-logout" action="{{ route('admin.logout') }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <style>
            .treeview-menu i {
                width: 20px;
            }
        </style>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    @if (Auth::user()->avatar !== null)
                        <img src="{{ asset('storage/app/users/' . Auth::user()->avatar) }}" class="img-circle">
                    @else <img src="{{ asset('storage/app/users/user-default.png') }}" class="img-circle">
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="{{ route('admin.home') }}"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MENU</li>
                <li class="{{ Request::is('admin') ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <i class="fas fa-home"></i><span> Trang chủ</span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/products') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Sản phẩm</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.products') }}"><i class="fas fa-list"></i> Danh sách sản phẩm</a>
                        </li>
                        <li><a href="{{ route('admin.products.get_add_product') }}"><i class="fas fa-plus-square"></i>
                                Thêm
                                sản phẩm</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/orders') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders') }}">
                        <i class="fas fa-cart-arrow-down"></i> <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/statistics') ? 'active' : '' }}">
                    <a href="{{ route('admin.statistics') }}">
                        <i class="fa fa-credit-card"></i> <span>Thống kê</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers') }}">
                        <i class="fas fa-user-friends"></i> <span>Khách hàng</span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/news') ? 'active' : '' }}">
                    <a href="#">
                        <i class="far fa-newspaper"></i>
                        <span>Tin tức</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.news') }}"><i class="fas fa-list"></i> Danh sách tin tức</a></li>
                        <li><a href="{{ route('admin.news.get_add_new') }}"><i class="fas fa-plus-square"></i> Thêm mới
                                tin
                                tức</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {{ Request::is('admin/banners') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fas fa-percent"></i> <span>Tin khuyến mãi</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.banners') }}"><i class="fas fa-list"></i> Danh sách tin khuyến
                                mãi</a></li>
                        <li><a href="{{ route('admin.banners.get_add_banner') }}"><i class="fas fa-plus-square"></i> Thêm
                                mới
                                tin khuyến mãi</a></li>
                    </ul>
                </li>
                <li {{ Request::is('admin/categories') ? 'active' : '' }}>
                    <a href="{{ route('admin.categories') }}">
                        <i class="fas fa-th-list"></i> <span>Danh mục sản phẩm</span>
                    </a>
                </li>
                <li class="treeview {{ Request::is('admin/brands') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fab fa-firstdraft"></i> <span>Thương hiệu</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.brands') }}"><i class="fas fa-list"></i> Danh sách thương hiệu</a>
                        </li>
                        <li><a href="{{ route('admin.brands.get_add_brand') }}"><i class="fas fa-plus-square"></i> Thêm
                                thương hiệu</a></li>
                    </ul>
                </li>
                @if (Auth::user()->role == config('const.SUPER_ADMIN'))
                    <li class="treeview {{ Request::is('admin/users') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fas fa-user-shield"></i> <span>Nhân viên</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('admin.users') }}"><i class="fas fa-list"></i> Danh sách nhân
                                    viên</a>
                            </li>
                            <li><a href="{{ route('admin.users.get_add_user') }}"><i
                                        class="fas fa-plus-square"></i>
                                    Thêm
                                    nhân viên</a></li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="https://fb/buivansaobg">
                        <i class="fab fa-facebook-square"></i> <span>Fanpage</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    @yield('main')
</div>
<!-- ./wrapper -->
