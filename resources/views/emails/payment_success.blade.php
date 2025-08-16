<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thanh Toán Thành Công</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f6f6f6;">
    <table align="center" cellpadding="0" cellspacing="0" width="600"
        style="background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
            <td align="center" style="background-color: #d4a373; padding: 20px;">
                <img src="{{ asset('themes/client/assets/img/logo/logo_about.png') }}" alt="Logo Khách sạn"
                    width="150" style="display:block; margin-bottom: 10px;">
                <h1 style="color: #fff; margin: 0; font-size: 22px;">Xác nhận Thanh Toán Thành Công</h1>
            </td>
        </tr>

        <!-- Nội dung -->
        <tr>
            <td style="padding: 20px;">
                <p style="font-size: 16px; color: #333;">Xin chào <strong>{{ $booking->user->name }}</strong>,</p>
                <p style="font-size: 14px; color: #555;">Cảm ơn bạn đã đặt phòng tại khách sạn của chúng tôi! Dưới đây
                    là thông tin đặt phòng của bạn:</p>

                <table width="100%" cellpadding="6" cellspacing="0"
                    style="border-collapse: collapse; background: #fafafa; margin-top: 10px;">
                    <tr>
                        <td><strong>Mã đặt phòng:</strong></td>
                        <td>{{ $booking->booking_code }}</td>
                    </tr>
                    <tr>
                        <td><strong>Ngày nhận phòng:</strong></td>
                        <td>{{ $booking->check_in->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Ngày trả phòng:</strong></td>
                        <td>{{ $booking->check_out->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Số lượng phòng:</strong></td>
                        <td>{{ $booking->room_quantity }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tổng tiền:</strong></td>
                        <td>{{ number_format($booking->total_price, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td><strong>Đã thanh toán:</strong></td>
                        <td>{{ number_format($booking->paid_amount, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td><strong>Còn lại:</strong></td>
                        <td>{{ number_format($booking->total_price - $booking->paid_amount, 0, ',', '.') }} VND</td>
                    </tr>
                    <tr>
                        <td><strong>Phương thức thanh toán:</strong></td>
                        <td>{{ $booking->payments->first()?->method ?? 'Không xác định' }}</td>
                    </tr>
                </table>

                @if ($booking->status == 'partial' || $booking->status == 'paid')
                    <p style="font-size: 14px; color: #2b7a2b; margin-top: 15px;">
                        ✅ Thanh toán qua {{ $booking->payments->first()?->method ?? 'cổng thanh toán' }} đã hoàn tất.
                        Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!
                    </p>
                @endif

                <p style="font-size: 14px; color: #555;">Trân trọng,<br>Đội ngũ khách sạn</p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="background-color: #f0f0f0; padding: 15px; font-size: 12px; color: #777;">
                © {{ date('Y') }} {{ config('app.name') }} - Mọi quyền được bảo lưu.
            </td>
        </tr>
    </table>
</body>

</html>
