$(document).ready(function () {

    // Delete banners
    $('.btn-del-banner').click(function (e) {
        if (confirm('Bạn chắc chắn muốn xóa tin khuyến mãi này ?')) {
            var id = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                method: 'DELETE',
                dataType: 'json',
                data: {_token: $('meta[name="csrf-token"]').attr('content'),},
                success: function () {
                    swal.fire(
                        'Thành công',
                        'Bạn đã xóa tin khuyến mãi thành công',
                        'success',
                    );
                    $('#banner' + id + '> .status').text('Ẩn');
                    $('#banner' + id + '> .function > .on').addClass('hidden');
                    $('#banner' + id + '> .function > .off').removeClass('hidden');
                },
                error: function () {
                    swal.fire(
                        'Thông báo',
                        'Đã xảy ra lỗi, hãy thử lại sau !',
                        'error',
                    );
                }
            });
        }
        e.preventDefault();
    });

    // Restore banners
    $('.btn-restore-banner').click(function (e) {
        if (confirm('Bạn chắc chắn muốn hiện tin khuyến mãi này ?')) {
            var id = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: {_token: $('meta[name="csrf-token"]').attr('content'),},
                success: function () {
                    swal.fire(
                        'Thành công',
                        'Bạn đã khôi phục tin khuyến mãi thành công',
                        'success',
                    );
                    $('#banner' + id + '> .status').text('Hiện');
                    $('#banner' + id + '> .function > .on').removeClass('hidden');
                    $('#banner' + id + '> .function > .off').addClass('hidden');
                },
                error: function () {
                    swal.fire(
                        'Thông báo',
                        'Đã xảy ra lỗi, hãy thử lại sau !',
                        'error',
                    );
                }
            });
        }
        e.preventDefault();
    });
});
