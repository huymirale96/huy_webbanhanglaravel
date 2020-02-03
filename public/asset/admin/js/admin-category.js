$(document).ready(function () {

    // Get category
    $('.btn-edit-cate').click(function () {
        $('#name').val($(this).data('name'));
        $('#icon').html(' Icon hiện tại: ' + $(this).data('icon'));
        $('#icon-string').val($(this).data('icon'));
        $('#id').val($(this).data('id'));
    });

    // Submit edit category
    $('.btn-submit-edit-cate').click(function () {
        var id = $('#id').val();
        var name = $('#name').val();
        var icon = $('#icon-string').val();
        var URL = '/admin/categories/' + id + '/edit';
        $.ajax({
            url: URL,
            type: 'POST',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: name,
                icon: icon,
                id: id,
            },
            success: function (data) {
                swal.fire(
                    'Thành công',
                    'Bạn đã cập nhật danh mục ' + data.name + ' thành công',
                    'success',
                );
                $('#name').val('');
                $('#icon').html('');
                $('#icon-string').val('');
                $('#id').val('');
                $('.btn-edit-cate').attr('data-id', data.id);
                $('.btn-edit-cate').attr('data-name', data.name);
                $('.btn-edit-cate').attr('data-icon', data.icon);
                $('#cate' + id + ' > .cate_name').text(data.name);
                $('#cate' + id + ' > .cate_icon').html(data.icon);
                $("#box-edit").removeClass("in");
                $(".modal-backdrop").remove();
                $("#box-edit").hide();
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
