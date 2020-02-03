@extends('admin.layout.index')
@section('title','Danh sách tin tức')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header row">
            <h1 class="col-md-4">
                Thống kê doanh thu
            </h1>
            <h1 class="col-md-8">
                <form action="{{ route('admin.statistics') }}" method="GET">
                    <small>Tháng</small>
                    <select name="month" class="col-md-3">
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 1) || $month == 1) selected @endif value="1">1</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 2) || $month == 2) selected @endif value="2">2</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 3) || $month == 3) selected @endif value="3">3</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 4) || $month == 4) selected @endif value="4">4</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 5) || $month == 5) selected @endif value="5">5</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 6) || $month == 6) selected @endif value="6">6</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 7) || $month == 7) selected @endif value="7">7</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 8) || $month == 8) selected @endif value="8">8</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 9) || $month == 9) selected @endif value="9">9</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 10) || $month == 10) selected @endif value="10">10</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 11) || $month == 11) selected @endif value="11">11</option>
                        <option @if ((isset($_GET['month']) && $_GET['month'] == 12) || $month == 12) selected @endif value="12">12</option>
                    </select>
                    <small>năm</small>
                    <select name="year" class="col-md-4">
                        <option @if ((isset($_GET['year']) && $_GET['year'] == 2019) || $year == 2019) selected @endif value="2019">2019</option>
                        <option @if ((isset($_GET['year']) && $_GET['year'] == 2020) || $year == 2020)selected @endif value="2020">2020</option>
                    </select>
                    <button type="submit" class="btn btn-primary">OK</button>
                </form>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ number_format($products->money) }} <sup>đ</sup></h3>
                            <p>Tổng doanh thu</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money-bill-alt"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $products->quantity }}</h3>
                            <p>Sản phẩm bán ra</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $customers }}</h3>
                            <p>Khách hàng đăng ký mới</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $orders }}</h3>
                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng số sản phẩm</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listOrders as $item)
                                    <tr>
                                        <td>{{ $item->order_id }}</td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->money) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3"><b>TỔNG</b></td>
                                    <td>{{ $products->quantity }}</td>
                                    <td>{{ number_format($products->money) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!--/.row-->
@stop
