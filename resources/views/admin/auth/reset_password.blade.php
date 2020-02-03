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
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div id="message"></div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form id="form" class="login100-form validate-form" action="{{ route('admin.reset_password') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $user->token }}">
                <span class="login100-form-logo">
						<span style="color: #337ab7; font-size: 90px">S</span>
					</span>
                <span id="title-login" class="login100-form-title p-b-34 p-t-27">
						MẬT KHẨU
					</span>
                <label class="text-center" style="color: #fff; margin-bottom: 20px">Đặt mật khẩu cho tài khoản {{ $user->name }}</label>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" placeholder="Mật khẩu mới" id="password"
                           type="password"
                           name="password" required autocomplete="new-password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input placeholder="Xác nhận mật khẩu" id="password-confirm" type="password" class="input100"
                           name="password_confirmation" required
                           autocomplete="new-password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button id="submit" type="submit" class="login100-form-btn">
                        OK
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

