<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt Phòng Thành Công - Lumora Hotel</title>
</head>

<body style="font-family: 'Cormorant Garamond', serif; margin: 0; color: #333;">

    <div class="email-container"
        style="max-width: 650px; margin: auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); animation: fadeIn 1.2s ease-in-out;">
        <!-- Header -->
        <div class="email-header"
            style="background-color: #b38b59; padding: 20px 20px; text-align: center; position: relative;">
            <h1 style="position: relative; z-index: 2; color: #fff; margin: 0; font-size: 28px; font-weight: 600;">Đặt
                Phòng Thành Công</h1>
        </div>

        <!-- Body -->
        <div class="email-body" style="padding: 30px; line-height: 1.6;">
            <h2 style="color: #b38b59; font-size: 22px; margin-top: 0;">Xin chào {{ $booking->user->name }},</h2>
            <p>Cảm ơn bạn đã tin tưởng và đặt phòng tại <strong>Lumora Hotel</strong>! Chúng tôi rất hân hạnh được đón
                tiếp bạn.</p>

            <div class="booking-info"
                style="background: #f9f6f2; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #eee; border-collapse: collapse;">
                <h3>Thông tin đặt phòng:</h3>
                <table>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Mã đặt:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">{{ $booking->booking_code }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Ngày nhận phòng:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">
                            {{ $booking->check_in->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Ngày trả phòng:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">
                            {{ $booking->check_out->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Số lượng:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">{{ $booking->room_quantity }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Tổng tiền:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">
                            {{ number_format($booking->total_price, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Đã thanh toán:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">
                            {{ number_format($booking->paid_amount, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Còn lại:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">
                            {{ number_format($booking->total_price - $booking->paid_amount, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 10px; vertical-align: top; font-weight: bold; width: 40%;"
                            width="40%" valign="top"><strong>Phương thức thanh toán:</strong></td>
                        <td style="padding: 8px 10px; vertical-align: top;" valign="top">
                            {{ $booking->payments->first()?->method ?? 'Không xác định' }}</td>
                    </tr>
                </table>
            </div>

            @if ($booking->status == 'partial' || $booking->status == 'paid')
                <p><strong>Thanh toán qua {{ $booking->payments->first()?->method ?? 'cổng thanh toán' }} đã hoàn
                        tất.</strong> Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
            @endif

            <p>Chúc bạn có một kỳ nghỉ tuyệt vời và đáng nhớ!</p>
            <p>Trân trọng,<br>Đội ngũ <strong>Lumora Hotel</strong></p>
        </div>

        <!-- Footer -->
        <div class="email-footer"
            style="background: #b38b59; color: #fff; text-align: center; padding: 15px; font-size: 14px;">
            &copy; {{ date('Y') }} Lumora Hotel. Mọi quyền được bảo lưu.
        </div>
    </div>

</body>

</html>
