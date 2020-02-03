(function ($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function () {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        } else {
            if ($(input).val().trim() == '') {
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function () {
        if (showPass == 0) {
            $(this).next('input').attr('type', 'text');
            $(this).addClass('active');
            showPass = 1;
        } else {
            $(this).next('input').attr('type', 'password');
            $(this).removeClass('active');
            showPass = 0;
        }

    });


    //Modal forgot password
    $('#btn-open-modal').click(function () {
        $('#form-forgot-password').modal('show');
    });
    $('#btn-close-modal').click(function () {
        $('#form-forgot-password').modal('hide');
    });
    $('#send-request-modal').click(function (e) {
        var URL = $(this).attr('data-url');
        var email = $('#email').val();
        if (email === '') {
            alert('Địa chỉ email không được bỏ trống');
            $('#email').focus();
            return false;
        }
        let timerInterval;
        Swal.fire({
            title: 'Chờ một xíu',
            html: 'Yêu cầu của bạn đang được thực hiện.',
            // timer: 7000,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            onClose: () => {
                clearInterval(timerInterval)
            }
        });
        $.ajax({
            url: URL,
            method: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
            },
            success: function () {
                $('#form-forgot-password').modal('hide');
                Swal.close();
                Swal.fire(
                    'Thành công',
                    'Chúng tôi đã gửi yêu cầu đặt lại tới email của bạn.',
                    'error',
                );
            },
            error: function () {
                Swal.close();
                Swal.fire(
                    'Opppss',
                    'Địa chỉ email không tồn tại!',
                    'error',
                );
                $('#email').val('');
            }
        });
        e.preventDefault();
    });
    //end forgot password
})(jQuery);

