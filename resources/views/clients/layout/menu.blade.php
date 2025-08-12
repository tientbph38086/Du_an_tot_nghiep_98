<div class="lh-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ $systems->logo ? asset('storage/' . $systems->logo) : asset('assets/client/assets/img/logo/logo-2.png') }}" alt="Logo" class="lh-logo">
            </a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-2-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Trang Chủ</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('room.view') }}">Danh sách loại phòng</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('introductions') }}">Giới thiệu</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client.posts.index') }}">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('policies') }}">Chính sách</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts') }}">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.promotions.index') }}">Ưu đãi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faqs') }}">Câu hỏi thường gặp</a>
                    </li>
                    @if (Route::has('login'))
                        <li class="nav-item dropdown">
                            @auth
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-user-2-fill me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mdi mdi-account me-2"></i>Hồ sơ</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bookings.index') }}"><i class="ri-contacts-book-line me-2"></i>Đơn đặt phòng</a></li>
                                    <li><a class="dropdown-item" href="{{ route('payments.lists') }}"><i class="ri-bank-card-2-line me-2"></i>Lịch sử giao dịch</a></li>
                                    @hasanyrole('superadmin|admin|staff')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="ri-dashboard-3-line me-2"></i>Truy cập quản trị</a></li>
                                    @endhasanyrole
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="ri-logout-box-line me-2"></i>Đăng xuất</button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a class="nav-link" href="{{ route('login') }}"><i class="ri-user-2-fill me-1"></i>Đăng nhập</a>
                            @endif
                        </li>
                        @if (Route::has('register') && !Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="ri-user-add-fill me-1"></i>Đăng ký</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
