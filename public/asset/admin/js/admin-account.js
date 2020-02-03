$(document).ready(function () {
    // Delete account
    $('.btn-del-account').click(function (e) {
        if (confirm("Bạn chắc chắn muốn xóa tài khoản này?")) {
            var id = $(this).data('id');
            var URL = $(this).data('url');
            $.ajax({
                url: URL,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function (user) {
                    $('#account' + id + '> .status').text('Đã nghỉ');
                    $('#account' + id + '> .function .on').addClass('hidden');
                    $('#account' + id + '> .function .off').removeClass('hidden');
                    swal.fire(
                        'Thành công',
                        'Bạn đã xóa tài khoản ' + user.name + ' thành công',
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

    // Restore account
    $('.btn-restore-account').click(function (e) {
        if (confirm("Bạn chắc chắn muốn khôi phục tài khoản này?")) {
            let timerInterval;
            Swal.fire({
                title: 'Chờ một xíu',
                html: 'Yêu cầu khôi phục tài khoản đang được thực hiện',
                // timer: 7000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            });
            var id = $(this).data('id');
            var URL = $(this).data('url');
            $.ajax({
                url: URL,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function (user) {
                    swal.close();
                    swal.fire(
                        'Thành công',
                        'Bạn đã khôi phục tài khoản' + user.name + ' thành công',
                        'Vui lòng chờ tài khoản được kích hoạt',
                        'success',
                    );
                    $('#account' + id + '> .status').text('Chờ xác thực');
                    $('#account' + id + '> .function .on').removeClass('hidden');
                    $('#account' + id + '> .function .off').addClass('hidden');
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

    // Reset account
    $('.btn-reset-account').click(function (e) {
        if (confirm("Bạn chắc chắn muốn đặt lại tài khoản này?")) {
            let timerInterval;
            Swal.fire({
                title: 'Chờ một xíu',
                html: 'Yêu cầu đặt lại tài khoản đang được thực hiện',
                // timer: 7000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            });
            var id = $(this).data('id');
            var URL = $(this).data('url');
            $.ajax({
                url: URL,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function (user) {
                    swal.close();
                    swal.fire(
                        'Thành công',
                        'Bạn đã đặt lại' + user.name + ' thành công.',
                        'Vui lòng chờ tài khoản được kích hoạt',
                        'success',
                    );
                    $('#account' + id + '> .status').text('Chờ xác thực');
                    // $('#account' + id + '> .function .on').removeClass('hidden');
                    // $('#account' + id + '> .function .off').addClass('hidden');
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
});
