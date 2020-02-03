<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        .container {
            background-color: #f7f7f7;
            margin: auto;
            padding: 15px;
            max-width: 610px;
            font-family: sans-serif;
        }
        .content > p {
            text-align: justify;
        }
        .btn-reset {
            margin: 0 auto;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            background-color: #fe585a;
            padding: 10px 20px;
            border-radius: 4px;
        }
        .name {
            font-weight: bold;
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
    </style>
</head>
<body>
<div class="container">
    <div class="banner">
        BUIVANSAO.TECH
    </div>
    <div class="name">
        Xin chào {{ $name }},
    </div>
    <div class="content">
        <p>Bạn nhận được mail này vì chúng tôi đã nhận được yêu cầu lấy lại mật khẩu cho tài khoản của bạn.</p>
        <p>Nếu bạn không gửi yêu cầu, bạn có thể bỏ qua thông báo này. Tài khoản của bạn vẫn an toàn.</p>
        <center><a href="{{ route('admin.check_token', $token) }}" class="btn-reset">Đặt lại mật khẩu</a></center>
        <p>Xin cảm ơn!</p>
        <p><small>Nếu không truy cập được link, hãy sao chép đường dẫn sau và dán vào thanh địa chỉ của trình duyệt:
                {{ route('admin.check_token', $token) }}</small></p>
        <p><small>Nếu có bất kỳ thắc mắc nào, hãy phản hồi tới chúng tôi tại website <a href="buivansao.tech">buivansao.tech</a>
                hoặc gọi điện tới hotline: 0363.07.12.98.
                <br>Đây là thư tự động, vui lòng không trả lời thư này!
            </small></p>
    </div>
</div>
</body>
</html>
