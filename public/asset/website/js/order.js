$(function () {
    //Order detail
    $('.btn-order-detail').click(function () {
        var url = $(this).data('url');
        var id = $(this).data('id');
        $.ajax({
            url: url,
            dataType: 'json',
            method: 'GET',
            data: {
                id: id,
            },
            success: function (res) {
                $('#bill').html('ĐƠN HÀNG SỐ: <b>' + res.order.order_id + '</b>');
                $('#created_at').text('Ngày đặt: ' + res.order.created_at);
                $('#cart_name').text(' ' + res.customer.name);
                $('#cart_phone').text(' ' + res.customer.phone);
                $('#cart_email').text(' ' + res.customer.email);
                $('#cart_address').html('&nbsp' + res.order.address + ', ' + res.address[0].w_name + ', ' + res.address[0].d_name + ', ' + res.address[0].p_name);
                $('#cart_note').html('&nbsp' + res.order.note);
                var pt = ' Chờ thanh toán';
                if (res.order.pay_status == 1) {
                    pt = ' Đã thanh toán'
                }
                var pm = ' Thanh toán tiền mặt';
                if (res.order.payment_method == 1) {
                    pm = ' Thanh toán qua VNPay';
                }
                $('#pay_status').text(pt);
                $('#payment_method').text(pm);
                switch (res.order.status) {
                    case 0: {
                        $('#cart_status').text(' Chờ xác nhận');
                        break;
                    }
                    case 1: {
                        $('#cart_status').text(' Đã xác nhận');
                        break;
                    }
                    case 2: {
                        $('#cart_status').text(' Đang giao hàng');
                        break;
                    }
                    case 3: {
                        $('#cart_status').text(' Đã giao hàng');
                        break;
                    }
                    case 4: {
                        $('#cart_status').text(' Đã hủy');
                        break;
                    }
                }
                var row = '';
                var sum_quantity = 0;
                var sum_money = 0;
                $.each(res.list, function (key, value) {
                    console.log(value);
                    row += "<tr><td><img width='70px' src='" + window.location.origin + "/storage/app/products/" + value.image + "'/></td>";
                    row += "<td>" + value.name + "<br>(" + value.product_type + ")</td>";
                    row += "<td>" + value.s_price.toLocaleString('vi') + "</td>";
                    row += "<td>" + value.p_price.toLocaleString('vi') + "</td>";
                    row += "<td>" + value.quantity.toLocaleString('vi') + "</td>";
                    row += "<td>" + (value.quantity * value.p_price).toLocaleString('vi') + "</td></tr>";
                    sum_quantity += value.quantity;
                    sum_money += value.quantity * value.p_price;
                });
                row += "<tr class='font-weight-normal'><td colspan='4' class='text-center'>";
                row += "<b>TỔNG THANH TOÁN (vnđ)</b></td><td>" + sum_quantity.toLocaleString('vi') + "</td>";
                row += "<td style='color: red; font-weight: bold'>" + sum_money.toLocaleString('vi') + "</td></tr>";
                $('.new-row').html(row);
            },
            error: function () {
                swal.fire(
                    'Thao tác thất bại',
                    'Đã xảy ra lỗi trong quá trình thực hiện. Hãy thử lại sau.',
                    'error',
                )
            }
        });
    });

    // Confirm order - COD
    $('#btn-confirm-order').click(function () {
        var url = $(this).data('url');
        if (customer_address == '') {
            $('.alert-danger').show();
            $('.alert-danger').append('<li>Địa chỉ không được bỏ trống</li>');
            $('#customer_address').focus();
            return false;
        }
        let timerInterval;
        Swal.fire({
            title: 'Chờ một xíu',
            html: 'Đơn hàng của bạn đang được khởi tạo',
            // timer: 7000,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
            onClose: () => {
                clearInterval(timerInterval)
            }
        });
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                customer_id: $('#customer_id').val(),
                ward_id: $('#ward').val(),
                address: $('#customer_address').val(),
                note: $('#note').val(),
                status: 0,
            },
            success: function () {
                $('.modal').modal('hide');
                Swal.close();
                Swal.fire(
                    'Yeahhhhh!',
                    'Đơn hàng của bạn đã tạo thành công. Chúng tôi sẽ sớm liên lạc với bạn để xác nhận đơn hàng.',
                    'success'
                );
                $('#note').val('');
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
                if (data.status === 500) {
                    $('#note').val('');
                    Swal.fire(
                        'Rất tiếc',
                        'Sản phẩm đã hết hàng, mong quý khách thông cảm',
                        'error',
                    );
                }
            },
        });
    });

    // Confirm order - VNPAY
    $('#btn-confirm-order-atm').click(function () {
        $.ajax({
            url: $(this).data('url'),
            method: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                customer_id: $('#customer_id').val(),
                ward_id: $('#ward').val(),
                address: $('#customer_address').val(),
                note: $('#note').val(),
                payment_method: 1,
                status: 0,
            },
            success: function (vnp_Url) {
                window.location.href = vnp_Url;
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
                if (data.status === 500) {
                    $('#note').val('');
                    Swal.fire(
                        'Rất tiếc',
                        'Sản phẩm đã hết hàng, mong quý khách thông cảm',
                        'error'
                    );
                }
            },
        });
    });
});
