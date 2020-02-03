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
            <input type="hidden" id="host" value="{{ asset('/') }}">
            <input type="hidden" id="token" name="token" value="{{ $customer->token }}">
            <div class="alert alert-danger" style="display:none"></div>
            <span class="login100-form-logo">
						<span style="color: #337ab7; font-size: 90px">S</span>
					</span>
            <span id="title-login" class="login100-form-title p-b-34 p-t-27">
						ĐẶT LẠI MẬT KHẨU
					</span>
            <label class="text-center" style="color: #fff; margin-bottom: 20px">Đặt lại mật khẩu cho tài
                khoản <br> {{ $customer->email }}</label>
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
                <button data-url="{{ route('customer.set_password') }}" id="submit" type="submit" class="login100-form-btn">
                    OK
                </button>
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
    $(document).ready(function () {
        $('#submit').click(function () {
            var password1 = $('#password').val();
            var password2 = $('#password-confirm').val();
            $.ajax({
                url: $(this).data('url'),
                method: 'post',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    token: $('#token').val(),
                    password: password1,
                    password_confirmation: password2,
                },
                success: function (data) {
                    swal.fire(
                        'Thành công',
                        'Bạn đã đặt lại mật khẩu thành công',
                        'success',
                    ).then(okay => {
                        if (okay) {
                            window.location.href = $('#host').val();
                        }
                    });
                    $('#password').val('');
                    $('#password-confirm').val('');
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    if (data.status === 422) {
                        $('.alert-danger').html('');
                        $.each(errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                        $('#password').val('');
                        $('#password-confirm').val('');
                    }
                }
            });
        });
    })
</script>
</body>
</html>

