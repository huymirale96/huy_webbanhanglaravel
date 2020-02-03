$(document).ready(function () {

    // Delete products
    $('.btn-del-product').click(function (e) {
        if (confirm("Bạn chắc chắn muốn xóa sản phẩm này?")) {
            var id = $(this).data('id');
            var URL = $(this).data('url');
            $.ajax({
                url: URL,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function (product) {
                    $('#product' + id + '> .status').text('Ngừng kinh doanh');
                    $('#product' + id + '> .function .on').addClass('hidden');
                    $('#product' + id + '> .function .off').removeClass('hidden');
                    swal.fire(
                        'Thành công',
                        'Bạn đã xóa sản phẩm ' + product.name + ' thành công',
                        'success',
                    );
                },
                error: function () {
                    swal.fire(
                        'Thông báo',
                        'Đã xảy ra lỗi, hãy thử lại sau !',
                        'error',
                    );
                }
            })
        } else return false;
    });

    // Restore products
    $('.btn-restore-product').click(function (e) {
        if (confirm("Bạn chắc chắn muốn khôi phục sản phẩm này?")) {
            var id = $(this).data('id');
            var URL = $(this).data('url');
            $.ajax({
                url: URL,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function (product) {
                    swal.fire(
                        'Thành công',
                        'Bạn đã khôi phục ' + product.name + ' thành công',
                        'success',
                    );
                    $('#product' + id + '> .status').text('Đang bán');
                    $('#product' + id + '> .function .on').removeClass('hidden');
                    $('#product' + id + '> .function .off').addClass('hidden');
                },
                error: function () {
                    swal.fire(
                        'Thông báo',
                        'Đã xảy ra lỗi, hãy thử lại sau !',
                        'error',
                    );
                }
            })
        } else return false;
    });

    // Delete product's image
    $('.btn-del-img').click(function (e) {
        if (confirm("Bạn chắc chắn muốn xóa ảnh này?")) {
            var URL = $(this).data('url');
            var id = $(this).data('id');
            $.ajax({
                url: URL,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function () {
                    $.toast({
                        heading: 'Thành công',
                        text: 'Bạn đã xóa ảnh thành công',
                        icon: 'success',
                        position: 'top-right',
                    });
                    $('#img' + id).remove();
                },
                error: function () {
                    $.toast({
                        heading: 'Thất bại',
                        text: 'Đã xảy ra lỗi, hãy thử lại sau.',
                        icon: 'error',
                        position: 'top-right',
                    });
                }
            })
        }
        e.preventDefault();
    });

    // Delete product's options
    $('.btn-del-option').click(function (e) {
        if (confirm("Bạn chắc chắn muốn xóa chi tiết này ?")) {
            var URL = $(this).data('url');
            var id = $(this).data('id');
            $.ajax({
                url: URL,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function () {
                    $.toast({
                        heading: 'Thành công',
                        text: 'Bạn đã xóa thông tin thành công',
                        icon: 'success',
                        position: 'top-right',
                    });
                    $('#option' + id).remove();
                },
                error: function () {
                    $.toast({
                        heading: 'Thất bại',
                        text: 'Đã xảy ra lỗi, hãy thử lại sau.',
                        icon: 'error',
                        position: 'top-right',
                    });
                }
            })
        }
        e.preventDefault();
    });
});
