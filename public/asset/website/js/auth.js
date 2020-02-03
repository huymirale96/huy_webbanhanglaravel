$(document).ready(function () {
    // open login form
    $('#a-login').click(function () {
        $('#modal-login').modal('show');
    });
    // end login form

    // open signup form
    $('#a-signup').click(function () {
        $('#modal-register').modal('show');
    });
    // end signup form

    // Post login
    $('#btn-login').click(function (e) {
        var email = $('#i-email').val();
        var password = $('#i-password').val();
        if (email == '') {
            $('#modal-login .modal-body > span').text('Email không được bỏ trống !');
            return false;
        }
        if (password == '') {
            $('#modal-login .modal-body > span').text('Mật khẩu không được bỏ trống !');
            return false;
        }
        var URL = $(this).data('url');
        $.ajax({
            url: URL,
            method: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
                password: password,
            },
            success: function (name) {
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $.toast({
                    heading: 'Thành công',
                    text: 'Đăng nhập thành công',
                    icon: 'success',
                    position: 'top-right',
                });
                $('#i-password').val('');
                $('#i-email').val('');
                $('#modal-login').modal('hide');

                let track = '<li class="text-center text-white w-100">';
                track += '<a class="text-white" href="/don-hang">';
                track += '<i class="fas fa-truck"></i> Đơn hàng</a></li>';
                $('#track').html(track);

                let auth = '<button data-toggle="modal" data-target="#modal-profile"';
                auth += 'data-url="/cart/user-info" class="text-white btn" id="s-login">';
                auth += "<i class='far fa-user mr-2'></i>" + name + "</button>";
                $('#li-login').html(auth);

                let logout = "<button id='btn-logout' class='text-white btn' data-url='/logout'>";
                logout += "<i class='fas fa-sign-out-alt mr-2'></i>Đăng xuất</button>";
                $('#li-logout').html(logout);

            },
            error: function (data) {
                var errors = data.responseJSON;
                if (data.status === 422) {
                    $('.alert-danger').html('');
                    $.each(errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                }
                $('#modal-login .modal-body > #message').text('Tên tài khoản hoặc mật khẩu không chính xác !');
                $('#i-password').val('');
            },
        });
    });
    //end login

    //logout
    $(".agile-main-top").on("click", "#btn-logout", function () {
        var URL = $(this).data('url');
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: URL,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function () {
                $.toast({
                    heading: 'Thành công',
                    icon: 'success',
                    text: 'Bạn đã đăng xuất',
                    position: 'top-right',
                });
                $('#track').html('');
                let login = "<a id='a-login' href='' data-toggle='modal' data-target='#modal-login' class='text-white'>";
                login += "<i class='fas fa-sign-in-alt mr-2'></i>Đăng nhập </a>";
                $('#li-login').html(login);
                $('#li-login > #s-login').remove();
                let signup = "<a id='a-signup' href='#' data-toggle='modal' data-target='#modal-register' class='text-white'>";
                signup += "<i class='fas fa-sign-out-alt mr-2'></i>Đăng ký </a>";
                $('#li-logout').html(signup);
            },
            error: function () {
                alert('Đã có lỗi xảy ra, hãy thử lại sau !');
            },
        });
    });
    //end logout

    //Get profile
    $(".agile-main-top").on("click", "#s-login", function () {
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {},
            success: function (user) {
                $('#m-name').val(user.name);
                $('#m-email').val(user.email);
                $('#m-address').val(user.address);
                $('#m-phone').val(user.phone);
            },
        });
    });
    //End get profile

    $('#btn-change-profile').click(function () {
        var URL = $(this).data('url');
        var name = $('#m-name').val();
        var email = $('#m-email').val();
        var phone = $('#m-phone').val();
        var address = $('#m-address').val();
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: URL,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: name,
                email: email,
                phone: phone,
                address: address,
            },
            success: function () {
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                $('.modal').modal('hide');
                swal.fire(
                    "Hoàn tất",
                    "Bạn đã cập nhật thông tin tài khoản thành công.",
                    "success"
                );
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (data.status === 422) {
                    $('.alert-danger').html('');
                    $.each(errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                }
            }
        })
    });

    //register
    $('#btn-register').click(function () {
            var name = $('#u-name').val();
            var email = $('#u-email').val();
            var phone = $('#u-phone').val();
            var password1 = $('#u-password').val();
            var password2 = $('#u-confirm-password').val();
            let address = $('#u-address').val();
            var URL = $(this).data('url');
            if (name == '') {
                $('#modal-register .modal-body > #message').text('Họ tên không được bỏ trống !');
                return false;
            }
            if (email == '') {
                $('#modal-register .modal-body > #message').text('Email không được bỏ trống !');
                return false;
            }
            if (phone == '') {
                $('#modal-register .modal-body > #message').text('Số điện thoại không được bỏ trống !');
                return false;
            }
            if (password1 == '' || password2 == '') {
                $('#modal-login .modal-body > #message').text('Mật khẩu không được bỏ trống !');
                return false;
            }
            if (password1 != password2) {
                $('#modal-login .modal-body > #message').text('Mật khẩu không khớp !');
                return false;
            }
            if (address == '') {
                $('#modal-login .modal-body > #message').text('Địa chỉ không được bỏ trống !');
                return false;
            }
            let timerInterval;
            Swal.fire({
                title: 'Chờ một xíu',
                html: 'Yêu cầu tạo tài khoản của bạn đang được thực hiện',
                // timer: 7000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            });
            $.ajax({
                method: 'POST',
                dataType: 'json',
                url: URL,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: name,
                    email: email,
                    phone: phone,
                    address: address,
                    password: password1,
                    password_confirmation: password2,
                },
                success: function (res) {
                    swal.close();
                    $('.alert-danger').hide();
                    $('#modal-register').modal('hide');
                    $('#modal-login').modal('show');
                    swal.fire(
                        "Hoàn tất",
                        "Bạn đã đăng ký tài khoản thành công thành công.",
                        "success"
                    );
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    if (data.status === 422) {
                        $('.alert-danger').html('');
                        $.each(errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    }
                }
            });
        }
    );
    //end register

    // Forgot Password
    $('#btn-modal-forgot-password').click(function () {
        $('#modal-login').modal('hide');
    });

    $('#btn-forgot-password').click(function () {
        var email = $('#fp-email').val();
        let timerInterval;
        Swal.fire({
            title: 'Chờ một xíu',
            html: 'Yêu cầu của bạn đang đợc thực hiện',
            // timer: 7000,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            onClose: () => {
                clearInterval(timerInterval)
            }
        });
        $.ajax({
            url: $(this).data('url'),
            method: 'post',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
            },
            success: function () {
                Swal.close();
                swal.fire(
                    'Thành công',
                    'Chúng tôi đã gửi yêu cầu tới email của bạn. Lưu ý, yêu cầu chỉ có hiệu lực trong 24h',
                    'success',
                );
                $('#fp-email').val('');
                $('#modal-forgot-password').modal('hide');
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (data.status === 400) {
                    swal.fire(
                        'Rất tiếc !',
                        'Chúng tôi không tìm thấy địa chỉ email này',
                        'error',
                    );
                    $('#fp-email').val('');
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                }
                if (data.status === 422) {
                    $('.alert-danger').html('');
                    $.each(errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                    $('#fp-email').val('');
                }
            }
        });
    });
    // End Forgot Password

    //Change password
    $('#btn-modal-changepass').click(function (e) {
        $('#modal-password').modal('show');
        $('#modal-profile').modal('hide');
    });

    $('#btn-close-changepass').click(function (e) {
        $('#modal-password').modal('hide');
        $('#modal-profile').modal('show');
    });

    $('#btn-submit-change-password').click(function () {
        var url = $(this).data('url');
        var current_password = $('#current_password').val();
        var new_pass = $('#new-password').val();
        var confirm_pass = $('#password-confirm').val();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                current_password: current_password,
                password: new_pass,
                password_confirmation: confirm_pass,
            },
            success: function () {
                $('.modal').modal('hide');
                swal.fire(
                    "Hoàn tất",
                    "Bạn đã đổi mật khẩu thành công thành công.</br>Tài khoản của bạn sẽ bị đăng xuất sau 3s.",
                    "success"
                );
                setTimeout(function () {
                    window.location.href = window.location.origin;
                }, 3000);
            },
            error: function (data, res) {
                var errors = data.responseJSON;
                if (data.status === 422) {
                    $('.alert-danger').html('');
                    $.each(errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>' + value + '</li>');
                    });
                }
            }
        });
    });
    //End change password

    $('#btn-close-modal').click(function () {
        $('.modal').modal('hide');
    });
});
