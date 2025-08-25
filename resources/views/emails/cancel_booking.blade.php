<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hủy Đặt Phòng - Lumora Hotel</title>
</head>

<body style="font-family: 'Arial', sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

    <div
        style="max-width: 650px; margin: auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);">

        <!-- Header -->
        <div style="background-color: #d9534f; padding: 30px 20px; text-align: center;">
            {{-- <img src="https://yourdomain.com/logo.png" alt="Lumora Hotel Logo" style="max-width: 150px; margin-bottom: 10px;"> --}}
            <h1 style="color: #fff; margin: 0; font-size: 26px;">Hủy Đặt Phòng Thành Công</h1>
        </div>

        <!-- Body -->
        <div style="padding: 30px; line-height: 1.6;">
            <h2 style="color: #d9534f; font-size: 20px; margin-top: 0;">
                Xin chào {{ $booking->user->name }},
            </h2>
            <p>Chúng tôi xác nhận rằng đơn đặt phòng của bạn tại <strong>Lumora Hotel</strong> đã được <strong>hủy thành
                    công</strong>.</p>

            <div style="background: #f9f6f2; padding: 20px; border-radius: 8px; border: 1px solid #eee; margin: 20px 0;">
                <h3 style="margin-top: 0;">Thông tin đặt phòng:</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 10px; font-weight: bold; width: 40%;">Mã đặt phòng:</td>
                        <td style="padding: 8px 10px;">{{ $booking->booking_code }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; font-weight: bold;">Ngày nhận phòng:</td>
                        <td style="padding: 8px 10px;">{{ $booking->check_in->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; font-weight: bold;">Ngày trả phòng:</td>
                        <td style="padding: 8px 10px;">{{ $booking->check_out->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; font-weight: bold;">Số lượng phòng:</td>
                        <td style="padding: 8px 10px;">{{ $booking->room_quantity }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; font-weight: bold;">Tổng tiền:</td>
                        <td style="padding: 8px 10px;">{{ number_format($booking->total_price, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; font-weight: bold;">Hoàn tiền:</td>
                        <td style="padding: 8px 10px;">
                            @if ($booking->refund && $booking->refund->amount > 0)
                                {{ number_format($booking->refund->amount, 0, ',', '.') }} VND
                            @else
                                <span style="color: #d9534f;">Quá thời gian 10 phút theo quy định của khách sạn</span>
                            @endif
                        </td>
                    </tr>
                    @if ($booking->refund && !empty($booking->refund->reason))
                        <tr>
                            <td style="padding: 8px 10px; font-weight: bold; color: #d9534f;">Lý do hủy:</td>
                            <td style="padding: 8px 10px; font-style: italic;">{{ $booking->refund->reason }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            <p style="color: #d9534f; font-weight: bold;">Chúng tôi rất tiếc khi phải hủy đơn của bạn và mong sẽ được
                phục vụ bạn vào một dịp khác!</p>

            <p>Trân trọng,<br>Đội ngũ <strong>Lumora Hotel</strong></p>
        </div>

        <!-- Footer -->
        <div style="background: #d9534f; color: #fff; text-align: center; padding: 15px; font-size: 14px;">
            &copy; {{ date('Y') }} Lumora Hotel. Mọi quyền được bảo lưu.
        </div>
    </div>

</body>

</html>
