<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh email - Lumora Hotel</title>

</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
    <div class="container"
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <div class="header" style="background-color: #2c7a7b; color: white; text-align: center; padding: 20px;">
            <h1 style="margin: 0; font-size: 22px;">🌟 Lumora Hotel</h1>
        </div>

        <!-- Content -->
        <div class="content" style="padding: 20px; color: #333333; line-height: 1.5;">
            <p>Xin chào <strong>{{ $user->name }}</strong>,</p>
            <p>Cảm ơn bạn đã đăng ký tài khoản tại <strong>Lumora Hotel</strong>.
                Vui lòng xác minh địa chỉ email của bạn để hoàn tất quá trình đăng ký.</p>
            <p style="text-align: center; margin: 25px 0;">
                <a href="{{ $verificationUrl }}" class="button"
                    style="display: inline-block; background-color: #2c7a7b; color: white; padding: 12px 20px; text-decoration: none; border-radius: 6px; font-weight: bold;">Xác
                    minh email</a>
            </p>
            <p>Nếu bạn không tạo tài khoản, vui lòng bỏ qua email này.</p>
        </div>

        <!-- Footer -->
        <div class="footer"
            style="text-align: center; font-size: 12px; color: #999999; padding: 15px; background-color: #f0f0f0;">
            &copy; {{ date('Y') }} Lumora Hotel. Mọi quyền được bảo lưu.
        </div>
    </div>
</body>

</html>
