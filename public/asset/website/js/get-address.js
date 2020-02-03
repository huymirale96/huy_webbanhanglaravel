$(function () {
    // Get districts
    $('#province').change(function () {
        var url = $(this).data('url');
        var id =  $(this).val();
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function (districts) {
                let option = '<label>Quận, huyện</label>';
                option += '<select data-url="/cart/wards" id="district" class="form-control">';
                $.each(districts, function (key, item) {
                    option += "<option value='" + item.id + "'>" + item.name + "</option>";
                });
                option += '</select>';
                $('.district').html(option);
            },
            error: function () {
                alert('Lỗi');
            },
        });
    });

    // Get wards
    $('#modal-confirm-order').on('change', '#district', function () {
        var url = $(this).data('url');
        var id =  $(this).val();
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function (wards) {
                var option = '<label>Thị trấn, xã</label>';
                option += '<select id="ward" class="form-control">';
                $.each(wards, function (key, item) {
                    option += "<option value='" + item.id + "'>" + item.name + "</option>";
                });
                option += '</select>';
                $('.ward').html(option);
            },
            error: function () {
                alert('Đã xảy ra lỗi.');
            },
        });
    });
});
