@extends('admin.layout.index')
@section('title', 'Trang chủ')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Trang chủ
            </h1>
        </section>

        <script>
            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Biểu đồ doanh thu theo tháng"
                    },
                    axisX: {
                        valueFormatString: "",
                        xValueType: 'dateTime',
                    },
                    data: [{
                        type: "spline",
                        markerSize: 5,
                        dataPoints: <?php echo json_encode($money, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $view_orders }}</h3>
                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <a href="{{ route('admin.orders') }}" class="small-box-footer">Xem danh sách <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $view_products }}</h3>
                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <a href="{{ route('admin.products') }}" class="small-box-footer">Xem danh sách <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $view_customers }}</h3>

                            <p>Khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="{{ route('admin.customers') }}" class="small-box-footer">Xem danh sách <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $view_users }}</h3>

                            <p>Nhân viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <a href="{{ route('admin.users') }}" class="small-box-footer">Xem danh sách <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="col-md-12">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop
