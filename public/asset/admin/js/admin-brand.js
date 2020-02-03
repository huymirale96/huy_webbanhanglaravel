$(document).ready(function () {

    // Delete brand
    $('.btn-del-brand').click(function (e) {
        if (confirm("Bạn chắc chắn muốn xóa thương hiệu này ?")) {
            let URL = $(this).data('url');
            var id = $(this).data('id');
            $.ajax({
                url: URL,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                },
                dataType: 'json',
                success: function (brand) {
                    swal.fire(
                        'Thành công',
                        'Bạn đã xóa thương hiệu ' + brand.name + ' thành công',
                        'success',
                    );
                    $('#brand' + id + '> .status').text('Ngừng kinh doanh');
                    $('#brand' + id + '> .function > .on').addClass('hidden');
                    $('#brand' + id + '> .function > .off').removeClass('hidden');
                },
                error: function () {
                    swal.fire(
                        'Thông báo',
                        'Đã xảy ra lỗi, hãy thử lại sau !',
                        'error',
                    );
                }
            })
        }
        e.preventDefault();
    });

    // Restore brand
    $('.btn-restore-brand').click(function (e) {
        if (confirm("Bạn chắc chắn muốn khôi phục thương hiệu này ?")) {
            let URL = $(this).data('url');
            var id = $(this).data('id');
            $.ajax({
                url: URL,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                },
                dataType: 'text',
                success: function (brand) {
                    swal.fire(
                        'Thành công',
                        'Bạn đã khôi phục thương hiệu ' + brand.name + ' thành công',
                        'success',
                    );
                    $('#brand' + id + '> .status').text('Đang hoạt động');
                    $('#brand' + id + '> .function > .on').removeClass('hidden');
                    $('#brand' + id + '> .function > .off').addClass('hidden');
                },
                error: function () {
                    swal.fire(
                        'Thông báo',
                        'Đã xảy ra lỗi, hãy thử lại sau !',
                        'error',
                    );
                }
            })
        }
        e.preventDefault();
    });
});
