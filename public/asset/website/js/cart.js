$(document).ready(function () {
    // Add product to cart
    $('.btn-add-cart').click(function () {
        let URL = $(this).data('url');
        let id = $(this).data('id');
        let type_id = $(this).data('type_id');
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: URL,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                type_id: type_id,
            },
            success: function (cart) {
                $.toast({
                    heading: 'Thành công',
                    text: 'Bạn đã thêm ' + cart.name + ' vào giỏ hàng',
                    icon: 'success',
                    position: 'top-right',
                });
            },
            error: function () {
                $.toast({
                    heading: 'Thất bại',
                    text: 'Đã có lỗi xảy ra. Hãy thử lại sau.',
                    icon: 'error',
                    position: 'top-right',
                })
            },
        });
    });

    // Close cart
    $('.btn-close').click(function () {
        $('.modal').modal('hide');
    });

    var sum_money = 0;
    // Show cart
    $('#btn-show-cart').click(function (e) {
        e.preventDefault();
        var URL = $(this).data('url');
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: URL,
            data: {},
            success: function (res) {
                var row = '';
                if (Object.keys(res.carts).length <= 0) {
                    $('.modal').modal('hide');
                    swal.fire(
                        "Opppps",
                        "Chưa có sản phẩm nào trong giỏ hàng",
                        "error"
                    );
                } else {
                    $.each(res.carts, function (key, item) {
                        row += "<tr id='row" + key + "'><td width='15%'><img width='50px' src='/storage/app/products/" + item.options.image + "' </td>";
                        row += "<td width='30%'>" + item.name + "<br>(" + item.options.product_type + ")</td>";
                        row += "<td width='15%' class='price'>" + item.price.toLocaleString('vi') + "</td>";
                        row += "<td width='15%'><input data-cart_id='" + key + "' min='1' max='5' style='max-width: 90px' type='number' class='qty form-control' value='" + item.qty + "'/></td>";
                        row += "<td width='15%' class='sub'>" + (item.qty * item.price).toLocaleString('vi') + "</td>";
                        row += "<td width='10%'><button class='btn btn-warning btn-xoa' data-id='" + key + "'><i class='far fa-trash-alt'></i></button></td></tr>"
                    });
                    $('tfoot').show();
                    $('.new-row').html(row);
                    $('#sum-money').text(res.money);
                    sum_money = res.money;
                }
            },
            error: function () {
                alert('Đã xảy ra lỗi, hãy thử lại sau!');
            }
        });
    });

    // Close sweet alert
    $('.swal2-confirm').click(function () {
        $('.modal').modal('hide');
    });

    // change quantity
    $(document).on('change', '.qty', function () {
        var id = $(this).data('cart_id');
        var new_qty = $(this).val();
        $.ajax({
            method: 'PUT',
            dataType: 'json',
            url: '/cart/' + id,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                new_quantity: new_qty,
            },
            success: function (res) {
                var money = res.product.promotion_price * new_qty;
                $('#row' + id + '> .sub').text(money.toLocaleString('vi', '.', ''));
                $('#sum-money').text(res.money);
            },
            error: function () {
                $(this).val($(this).defaultValue);
                alert('Xin lỗi! Không đủ số lượng sản phẩm này trong kho.');
            },
        });
    });

    // Remove one product
    $("#modal-order").on("click", ".btn-xoa", function () {
        var id = $(this).attr('data-id');
        $.ajax({
            method: 'DELETE',
            url: '/cart/' + id,
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (res) {
                $('#row' + id).remove();
                $('#sum-money').text(res.money.toLocaleString('vi', '.', ''));
                $.toast({
                    heading: 'Thành công',
                    text: 'Đã xóa ' + res.product.name + ' khỏi giỏ hàng',
                    position: 'top-right',
                    icon: 'success',
                })
            },
            error: function () {
                alert('Đã xảy ra lỗi, hãy thử lại sau.');
            }
        });
    });

    //delete all cart
    $('#delete-all-cart').click(function (e) {
        $.ajax({
            url: $(this).data('url'),
            method: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function () {
                $('.modal').modal('hide');
                swal.fire(
                    "^_^",
                    "Bạn đã xóa toàn bộ sản phẩm trong giỏ hàng",
                    "warning"
                );
            },
            error: function () {
                alert('Đã xảy ra lỗi');
            }
        })
    });

    // Fill customer's information to cart
    $('#btn-submit-cart').click(function (e) {
        e.preventDefault();
        $('#modal-order').modal('hide');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {},
            success: function (user) {
                $('#modal-confirm-order').modal('show');
                $('#customer_name').val(user.name);
                $('#customer_id').val(user.id);
                $('#customer_email').val(user.email);
                $('#customer_address').val(user.address);
                $('#customer_phone').val(user.phone);
            },
            error: function () {
                $('#modal-login').modal('show');
                Swal.fire(
                    'Opppss !',
                    'Bạn hãy đăng nhập trước xác nhận đặt hàng nhé',
                    'error',
                );
                $('#customer_name').val('');
                $('#customer_email').val('');
                $('#customer_address').val('');
                $('#customer_phone').val('');
                $('#note').val('');
            },
        });
    });

    $(function () {
        $('#product_typeeee').change(function () {
            $('#p_price').text(($(this).find(':selected').data('p_price')).toLocaleString('vi', ',', ''));
            $('#s_price').text(($(this).find(':selected').data('s_price')).toLocaleString('vi', ',', ''));
            $('.btn-add-cart').attr('data-type_id', $(this).val());
        });
    })
});
