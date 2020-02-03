$(document).ready(function () {

    // Show popup order detail
    $('.btn-order-detail').click(function (e) {
        let sum_quantity = 0;
        let sum_money = 0;
        let url = $(this).data('url');
        let id = $(this).data('id');
        let status = $(this).data('status');
        $('.selectpicker').val(status);
        $('.selectpicker').change();
        $('#customer-name').text($('#row' + id + '> .name').text());
        $('#customer-phone').text($('#row' + id + '> .phone').text());
        $('#customer-email').text($('#row' + id + '> .email').text());
        $('#address').text($('#row' + id + '> .address').text());
        $('#created-at').text('Ngày đặt: ' + $('#row' + id + '> .date').text());
        $('#note').val($(this).attr('data-note'));
        $('#btn-update-order').attr('data-id', id);
        $('#customer-name-print').text($('#row' + id + '> .name').text());
        $('#customer-phone-print').text($('#row' + id + '> .phone').text());
        $('#address-print').text($('#row' + id + '> .address').text());
        $('#created-at-print').text('Ngày đặt: ' + $('#row' + id + '> .date').text());
        var row_detail = '';
        var row_print = '';
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: url,
            data: {},
            success: function (res) {
                $('#modal-order').modal('show');
                $('#bill').html('MÃ HÓA ĐƠN: <b>' + res.order.order_id + '</b>');
                $('#bill-id-print').html('MÃ HÓA ĐƠN: <b>' + res.order.order_id + '</b>');
                var pt = ' Chờ thanh toán';
                if (res.order.pay_status == 1) {
                    pt = ' Đã thanh toán';
                }
                var pm = ' Thanh toán tiền mặt';
                if (res.order.payment_method == 1) {
                    pm = ' Thanh toán qua VNPay';
                }
                $('#payment_method').text(pm);
                $('#pay_status').text(pt);
                $.each(res.detail, function (i, item) {
                    row_detail += "<tr><td><img width='70px' src='/storage/app/products/" + item.product_image + "'></td>";
                    row_detail += "<td>" + item.product_name + "<br>(" + item.product_type + ")</td>";
                    row_detail += "<td>" + item.price.toLocaleString('vi') + "</td>";
                    row_detail += "<td>" + item.quantity.toLocaleString('vi') + "</td>";
                    row_detail += "<td>" + (item.quantity * item.price).toLocaleString('vi') + "</td></tr>";
                    sum_quantity += item.quantity;
                    sum_money += item.quantity * item.price;
                });
                row_detail += "<tr class='font-weight-normal'><td colspan='4' class='text-center'><b>TỔNG THANH TOÁN (vnđ)</b></td><td>" + sum_money.toLocaleString('vi') + "</td></tr>";
                $('.new-row-detail').html(row_detail);

                $.each(res.detail, function (i, item) {
                    row_print += "<tr><td>" + i + "</td>";
                    row_print += "<td>" + item.product_name + "<br>(" + item.product_type + ")</td>";
                    row_print += "<td>" + item.price.toLocaleString('vi') + "</td>";
                    row_print += "<td>" + item.quantity.toLocaleString('vi') + "</td>";
                    row_print += "<td>" + (item.quantity * item.price).toLocaleString('vi') + "</td></tr>";
                });
                row_print += "<tr class='font-weight-normal'><td colspan='4' class='text-center'><b>TỔNG THANH TOÁN (vnđ)</b></td><td>" + sum_money.toLocaleString('vi') + "</td></tr>";
                $('.bill-body .new-row-print').html(row_print);
            },
            error: function () {
                swal.fire(
                    'Thao tác thất bại',
                    'Đơn hàng này không tồn tại',
                    'error'
                );
                $('#modal-order').modal('hide');
            }
        });
        e.preventDefault();
    });

    // Print order's bill
    $('#btn-print-order').click(function () {
        window.print();
        return false;
    });

    // Update order
    $('#btn-update-order').click(function (e) {
        var id = $(this).data('id');
        var url = '/admin/orders/' + id + '/update';
        var note = $('#note').val();
        var status = $('#select').val();
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: url,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                note: note,
                status: status,
                id: id,
            },
            success: function (order) {
                //On modal
                $('#address').val(order.address);
                $('#note').val(order.note);

                //On list order table
                $('#row' + id + '> .address').text(order.address);
                $('#row' + id + '> .note').text(order.note);

                if (order.status == 0) {
                    $('#row' + id + '> .status').text('Chưa xác nhận');
                } else if (order.status == 1) {
                    $('#row' + id + '> .status').text('Đã xác nhận');
                } else if (order.status == 2) {
                    $('#row' + id + '> .status').text('Đang giao hàng');
                } else if (order.status == 3) {
                    $('#row' + id + '> .status').text('Đã giao hàng');
                    $('#pay_status').text('Đã thanh toán');
                } else {
                    $('#row' + id + '> .status').text('Đã hủy');
                }
                swal.fire(
                    'Thành công',
                    'Cập nhật thông tin đơn hàng thành công',
                    'success',
                );
            },
            error: function () {
                swal.fire(
                    'Thông báo',
                    'Đã xảy ra lỗi, hãy thử lại sau !',
                    'error',
                );
            },
        });
    });
});
