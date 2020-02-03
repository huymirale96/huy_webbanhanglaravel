<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('public/asset/login')}}/">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        .modal {
            position: absolute;
            float: left;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div id="message"></div>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="form" class="login100-form validate-form" action="{{ route('admin.post_login') }}" method="POST">
                @csrf
                <span class="login100-form-logo">
						<span style="color: #337ab7; font-size: 90px">S</span>
					</span>
                <span id="title-login" class="login100-form-title p-b-34 p-t-27">
						Đăng nhập
					</span>
                <div class="wrap-input100 validate-input" data-validate="Enter email">
                    <input value="{{ old('email') }}" class="input100" type="email" placeholder="Email" Name="email" required="">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div id="password" class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" placeholder="Mật khẩu" Name="password" required="">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div id="remember" class="contact100-form-checkbox">
                    <input class="input-checkbox100" type="checkbox" name="remember"
                           id="ckb1" {{ old('remember') ? 'checked' : '' }}>
                    <label class="label-checkbox100" for="ckb1">
                        Ghi nhớ đăng nhập
                    </label>
                </div>
                <div class="container-login100-form-btn">
                    <button id="submit" type="submit" class="login100-form-btn">
                        OK
                    </button>
                </div>
            </form>
            <div class="text-center" style="margin-top: 30px">
                <button class="btn btn-warning" data-target="#form-forgot-password" data-toggle="modal" id="btn-open-modal">
                    Quên mật khẩu ?
                </button>
            </div>
            <div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="form-forgot-password">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">QUÊN MẬT KHẨU</div>
                        <div class="modal-body">
                            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                                <label>Nhập email của bạn</label>
                                <input class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="send-request-modal" data-url="{{ route('admin.forgot_password') }}"
                                    class="btn btn-success">
                                Gửi yêu cầu
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>

