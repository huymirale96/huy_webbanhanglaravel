$(document).ready(function () {

    // Get customer's profile
    $('.btn-customer-profile').click(function () {
        var url = $(this).data('url');
        $('#name').text('');
        $('#email').text('');
        $('#phone').text('');
        $('#address').text('');
        $('#detail').text('');
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            data: {},
            success: function (data) {
                $('#name').text(' ' + data.customer.name);
                $('#email').text(' ' + data.customer.email);
                $('#phone').text(' ' + data.customer.phone);
                $('#address').text(' ' + data.ward.name + ', ' + data.district.name + ', ' + data.province.name);
                $('#detail').text(' ' + data.customer.address);
                var date = new Date(data.customer.created_at);
                day = date.getDate();
                month = date.getMonth() + 1;
                year = date.getFullYear();
                $('#created_at').text(' ' + day + '/' + month + '/' + year);
            },
            error: function () {
                alert('Lỗi');
            }
        });

    });
});
