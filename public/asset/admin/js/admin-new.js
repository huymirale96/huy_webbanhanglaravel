$(document).ready(function () {

    // Delete news
    $('.btn-delete-new').click(function (e) {
        if (confirm('Bạn chắc chắn muốn xóa tin tức này ?')) {
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
                        'Bạn đã xóa tin tức thành công',
                        'success',
                    );
                    $('#new' + id + '> .status').text('Ẩn');
                    $('#new' + id + '> .function > .on').addClass('hidden');
                    $('#new' + id + '> .function > .off').removeClass('hidden');
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


    // Restore news
    $('.btn-restore-new').click(function (e) {
        if (confirm('Bạn chắc chắn muốn hiện tin tức này ?')) {
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
                        'Bạn đã khôi phục tin tức thành công',
                        'success',
                    );
                    $('#new' + id + '> .status').text('Hiện');
                    $('#new' + id + '> .function > .on').removeClass('hidden');
                    $('#new' + id + '> .function > .off').addClass('hidden');
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
