<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .container {
            background-color: #f7f7f7;
            margin: auto;
            padding: 15px;
            max-width: 610px;
            font-family: sans-serif;
        }

        .banner {
            width: 100%;
            background-color: #cd1818;
            color: #fff;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .content > p {
            text-align: justify;
        }

        .name {
            font-weight: bold;
        }
    </style>
<body>
<div class="container">
    <div class="banner">
        BUIVANSAO.TECH
    </div>
    <div class="name">
        Xin chào {{ $customer_name }},
    </div>
    <div class="content">
        <p>Chúc mừng bạn đã đăng ký tài khoản thành công trên website buivansao.tech
            <br>
            Hãy ghé thăm website của chúng tôi thường xuyên để cập nhật những tin khuyến mãi mới nhất và chọn mua
            cho mình những sản phẩm chất lượng tốt nhất.
            <br>Chúng tôi rất hân hạnh khi được phục vụ bạn.
        </p>
        <p>Xin cảm ơn, chúc bạn một ngày mới tốt lành!</p>
        <p><small>Nếu có bất kỳ thắc mắc nào, hãy phản hồi tới chúng tôi tại website <a href="buivansao.tech">buivansao.tech</a>
                hoặc gọi điện tới hotline: 0363.07.12.98.
                <br>Đây là thư tự động, vui lòng không trả lời thư này!
            </small></p>
    </div>
</div>
</body>
</html>
