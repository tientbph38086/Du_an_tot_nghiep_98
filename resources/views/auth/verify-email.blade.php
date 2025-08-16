@extends('layouts.auth')

@section('content')
<x-guest-layout>
    <div class="verify-container">
        <div class="verify-card">
            <h1 class="verify-title">Xác minh email của bạn</h1>

            <p class="verify-text">
                Cảm ơn bạn đã đăng ký! <br>
                Trước khi bắt đầu, vui lòng xác minh địa chỉ email của mình bằng cách
                nhấp vào liên kết mà chúng tôi vừa gửi qua email cho bạn.
                <br><br>
                Nếu bạn không nhận được email, hãy bấm nút dưới đây để nhận lại.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="verify-success">
                    Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                </div>
            @endif

            <div class="verify-actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary">
                        Gửi lại email xác minh
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-link">
                        Đăng xuất
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

<style>
.verify-container {
    display: flex;
    justify-content: center;
    padding: 40px 15px;
}

.verify-card {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    text-align: center;
}

.verify-title {
    font-size: 24px;
    font-weight: 600;
    color: #b38b59;
    margin-bottom: 15px;
}

.verify-text {
    font-size: 15px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.verify-success {
    background: #e6f4ea;
    border: 1px solid #a3d9a5;
    color: #2e7d32;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.verify-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-primary {
    background: #b38b59;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-primary:hover {
    background: #9e7649;
}

.btn-link {
    background: none;
    border: none;
    color: #555;
    font-size: 14px;
    text-decoration: underline;
    cursor: pointer;
}
</style>
@endsection
