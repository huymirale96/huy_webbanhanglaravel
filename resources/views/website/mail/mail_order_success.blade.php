<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đặt hàng thành công</title>
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

        table {
            border-collapse: collapse;
            text-align: left;
            margin-top: 20px;
        }

        .bill span {
            padding-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="banner">
        BUIVANSAO.TECH
    </div>
    <div class="name">
        Xin chào {{ $customer->name }},
    </div>
    <div class="content">
        <p>Đơn hàng <b>{{ $order->order_id }}</b> của bạn đặt vào lúc
            <b>{{ date('H:i:s - d/m/Y', strtotime($order->created_at)) }}</b> đã được tạo thành công. <br>
            Chúng tôi sẽ liên lạc với bạn qua điện thoại trong thời gian sớm nhất để xác nhận đơn hàng.
        </p>
        <div class="bill">
            <h4>Chi tiết đơn hàng</h4>
            <p><b>Người đặt: </b>{{ $customer->name }}</p>
            <p><b>Trạng thái thanh toán: </b>
                @if ($order->pay_status == config('const.PAID')) Đã thanh toán
                @else Chờ thanh toán
                @endif
            </p>
            <p><b>Phương thức thanh toán:</b>
                @if ($order->payment_method == config('const.ATM')) Thanh toán VNPay
                @else Thanh toán tiền mặt
                @endif
            </p>
            <table border='1px' cellspacing='10px' cellpadding='10px'>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                @foreach ($detail as $item)
                    <tr>
                        <td><img height="100px" src="{{ asset('storage/app/products/' . $item->options->image) }}"
                                 alt=""></td>
                        <td>{{ $item->name }}<br>( {{ $item->options->product_type }})</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->qty * $item->price) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"><b>Tổng thanh toán (vnđ)</b></td>
                    <td>{{ number_format($total_money) }}</td>
                </tr>
            </table>
        </div>
        <p>Xin cảm ơn bạn đã đặt hàng trên hệ thống</p>
        <p><small>Nếu có bất kỳ thắc mắc nào, hãy phản hồi tới chúng tôi tại website <a href="buivansao.tech">buivansao.tech</a>
                hoặc gọi điện tới hotline: 0363.07.12.98.
                <br>Đây là thư tự động, vui lòng không trả lời thư này!
            </small></p>
    </div>
</div>
</body>
</html>
