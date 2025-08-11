<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\ReviewController as ClientReviewController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\StaffRoleController;
use App\Http\Controllers\Admin\StaffShiftController;
use App\Http\Controllers\Admin\ServicePlusController;
use App\Http\Controllers\Admin\IntroductionController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\RefundPolicyController;
use App\Http\Controllers\Admin\SaleRoomTypeController;
use App\Http\Controllers\Admin\StaffAttendanceController;
use App\Http\Controllers\Admin\RoomTypePromotionController;
use App\Http\Controllers\Admin\RulesAndRegulationController;
use App\Http\Controllers\Client\BookingController as ClientBookingController;
use App\Http\Controllers\Client\RefundController as ClientRefundController;
use App\Http\Controllers\Client\PromotionController as ClientPromotionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminAccountController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Nhóm xác thực người dùng
Route::middleware('auth')->group(function () {
    // quản lý hồ sơ người dùng
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// xác minh email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('verified', true);
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['throttle:6,1'])->name('verification.send');

// Bao gồm các xác thực
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
|  Admin
|--------------------------------------------------------------------------
| Các cho bảng điều khiển admin, được bảo vệ bởi middleware xác thực,
| xác minh email và phân quyền (superadmin, admin hoặc staff).
*/
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'verified', 'role:superadmin|admin|staff'])
    ->group(function () {
        // Bảng điều khiển admin
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // quản lý loại phòng
        Route::prefix('room-types')
            ->as('room_types.')
            ->group(function () {
                Route::get('/', [RoomTypeController::class, 'index'])->name('index');
                Route::get('/create', [RoomTypeController::class, 'create'])->name('create');
                Route::post('/store', [RoomTypeController::class, 'store'])->name('store');
                Route::get('{id}/edit', [RoomTypeController::class, 'edit'])->name('edit');
                Route::get('{id}/show', [RoomTypeController::class, 'show'])->name('show');
                Route::put('{id}/update', [RoomTypeController::class, 'update'])->name('update');
                Route::post('{id}/delete-image', [RoomTypeController::class, 'deleteImage'])->name('delete-image');
                Route::delete('{id}/destroy', [RoomTypeController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [RoomTypeController::class, 'trashed'])->name('trashed');
                Route::patch('{id}/restore', [RoomTypeController::class, 'restore'])->name('restore');
                Route::delete('{id}/force-delete', [RoomTypeController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý khuyến mãi loại phòng
        Route::prefix('room-types-promotion')
            ->as('room_types_promotion.')
            ->group(function () {
                Route::get('/', [RoomTypePromotionController::class, 'index'])->name('index');
                Route::get('/create', [RoomTypePromotionController::class, 'create'])->name('create');
                Route::post('/store', [RoomTypePromotionController::class, 'store'])->name('store');
                Route::get('{id}/edit', [RoomTypePromotionController::class, 'edit'])->name('edit');
                Route::get('{id}/show', [RoomTypePromotionController::class, 'show'])->name('show');
                Route::put('{id}/update', [RoomTypePromotionController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [RoomTypePromotionController::class, 'destroy'])->name('destroy');
            });

        // quản lý phòng
        Route::prefix('rooms')
            ->as('rooms.')
            ->group(function () {
                Route::get('/', [RoomController::class, 'index'])->name('index');
                Route::get('/create', [RoomController::class, 'create'])->name('create');
                Route::post('/store', [RoomController::class, 'store'])->name('store');
                Route::get('{room}/edit', [RoomController::class, 'edit'])->name('edit');
                Route::get('/booked', [RoomController::class, 'bookedRooms'])->name('booked'); // Danh sách phòng đã đặt
                Route::get('{id}/show', [RoomController::class, 'show'])->name('show');
                Route::put('{room}/update', [RoomController::class, 'update'])->name('update');
                Route::delete('{room}/destroy', [RoomController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [RoomController::class, 'trashed'])->name('trashed');
                Route::patch('/{room}/restore', [RoomController::class, 'restore'])->name('restore');
                Route::delete('/{room}/force-delete', [RoomController::class, 'forceDelete'])->name('forceDelete');
                Route::post('/{booking}/change-room', [RoomController::class, 'changeRoom'])->name('change-room'); // Đổi phòng
            });

        // quản lý cài đặt thanh toán
        Route::prefix('payment-settings')
            ->as('payment-settings.')
            ->group(function () {
                Route::get('/', [PaymentSettingController::class, 'index'])->name('index');
                Route::put('/', [PaymentSettingController::class, 'update'])->name('update');
            });

        // quản lý đặt phòng
        Route::prefix('bookings')
            ->as('bookings.')
            ->group(function () {
                Route::get('/', [BookingController::class, 'index'])->name('index');
                Route::get('/create', [BookingController::class, 'create'])->name('create');
                Route::post('/store', [BookingController::class, 'store'])->name('store');
                Route::post('/checkin/store', [BookingController::class, 'storeCheckIn'])->name('checkin.store'); // Lưu check-in
                Route::post('/paid/store', [BookingController::class, 'storePaid'])->name('paid.store'); // Lưu thanh toán
                Route::get('{id}/returnVnpay', [BookingController::class, 'returnVnpay'])->name('return.vnpay'); // Xử lý trả về VNPay
                Route::get('{id}/get-remaining-amount', [BookingController::class, 'getRemainingAmount'])->name('get-remaining-amount'); // Lấy số tiền còn lại
                Route::get('{id}/show', [BookingController::class, 'show'])->name('show');
                Route::post('{id}/service-plus', [BookingController::class, 'updateServicePlus'])->name('service_plus.update');
                Route::get('{id}/edit', [BookingController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [BookingController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [BookingController::class, 'destroy'])->name('destroy');
            });

        // quản lý hoàn tiền
        Route::prefix('refunds')
            ->as('refunds.')
            ->group(function () {
                Route::get('/{refund}/approve', [RefundController::class, 'showApproveForm'])->name('approve-form');
                Route::post('/{refund}/approve', [RefundController::class, 'approveRefund'])->name('approve'); // Duyệt hoàn tiền
                Route::get('/{refund}/details', [RefundController::class, 'getRefundDetails'])->name('details');
            });

        // quản lý chính sách hoàn tiền
        Route::prefix('refund-policies')
            ->as('refund-policies.')
            ->group(function () {
                Route::get('/', [RefundPolicyController::class, 'index'])->name('index');
                Route::get('/create', [RefundPolicyController::class, 'create'])->name('create');
                Route::post('/store', [RefundPolicyController::class, 'store'])->name('store');
                Route::get('{id}/edit', [RefundPolicyController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [RefundPolicyController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [RefundPolicyController::class, 'destroy'])->name('destroy');
            });

        // quản lý nhân viên
        Route::prefix('staffs')
            ->as('staffs.')
            ->group(function () {
                Route::get('/', [StaffController::class, 'index'])->name('index');
                Route::get('/create', [StaffController::class, 'create'])->name('create');
                Route::post('/store', [StaffController::class, 'store'])->name('store');
                Route::get('{staff}/show', [StaffController::class, 'show'])->name('show');
                Route::get('{staff}/edit', [StaffController::class, 'edit'])->name('edit');
                Route::put('{staff}/update', [StaffController::class, 'update'])->name('update');
                Route::delete('{staff}/destroy', [StaffController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [StaffController::class, 'trashed'])->name('trashed');
                Route::patch('/{staff}/restore', [StaffController::class, 'restore'])->name('restore');
                Route::delete('/{staff}/force-delete', [StaffController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý vai trò nhân viên
        Route::prefix('staff_roles')
            ->as('staff_roles.')
            ->group(function () {
                Route::get('/', [StaffRoleController::class, 'index'])->name('index');
                Route::get('/create', [StaffRoleController::class, 'create'])->name('create');
                Route::post('/store', [StaffRoleController::class, 'store'])->name('store');
                Route::get('{staffRole}/show', [StaffRoleController::class, 'show'])->name('show');
                Route::get('{staffRole}/edit', [StaffRoleController::class, 'edit'])->name('edit');
                Route::put('{staffRole}/update', [StaffRoleController::class, 'update'])->name('update');
                Route::delete('{staffRole}/destroy', [StaffRoleController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [StaffRoleController::class, 'trashed'])->name('trashed');
                Route::patch('/{staffRole}/restore', [StaffRoleController::class, 'restore'])->name('restore');
                Route::delete('/{staffRole}/force-delete', [StaffRoleController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý ca làm việc của nhân viên
        Route::prefix('staff_shifts')
            ->as('staff_shifts.')
            ->group(function () {
                Route::get('/', [StaffShiftController::class, 'index'])->name('index');
                Route::get('/create', [StaffShiftController::class, 'create'])->name('create');
                Route::post('/store', [StaffShiftController::class, 'store'])->name('store');
                Route::get('{staffShift}/show', [StaffShiftController::class, 'show'])->name('show');
                Route::get('{staffShift}/edit', [StaffShiftController::class, 'edit'])->name('edit');
                Route::put('{staffShift}/update', [StaffShiftController::class, 'update'])->name('update');
                Route::delete('{staffShift}/destroy', [StaffShiftController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [StaffShiftController::class, 'trashed'])->name('trashed');
                Route::patch('/{staffShift}/restore', [StaffShiftController::class, 'restore'])->name('restore');
                Route::delete('/{staffShift}/force-delete', [StaffShiftController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý điểm danh nhân viên
        Route::prefix('staff_attendances')
            ->as('staff_attendances.')
            ->group(function () {
                Route::get('/', [StaffAttendanceController::class, 'index'])->name('index');
                Route::post('/check-in', [StaffAttendanceController::class, 'checkIn'])->name('check-in'); // Check-in
                Route::post('/check-out', [StaffAttendanceController::class, 'checkOut'])->name('check-out'); // Check-out
            });

        // quản lý đánh giá
        Route::prefix('reviews')
            ->as('reviews.')
            ->group(function () {
                Route::get('/', [ReviewController::class, 'index'])->name('index');
                Route::get('{review}/show', [ReviewController::class, 'show'])->name('show');
                Route::post('{review}/response', [ReviewController::class, 'response'])->name('response');
                Route::delete('{review}/destroy', [ReviewController::class, 'destroy'])->name('destroy');
            });

        // quản lý quy định
        Route::prefix('rule-regulations')
            ->as('rule-regulations.')
            ->group(function () {
                Route::get('/', [RulesAndRegulationController::class, 'index'])->name('index');
                Route::get('/create', [RulesAndRegulationController::class, 'create'])->name('create');
                Route::post('/store', [RulesAndRegulationController::class, 'store'])->name('store');
                Route::get('{id}/edit', [RulesAndRegulationController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [RulesAndRegulationController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [RulesAndRegulationController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [RulesAndRegulationController::class, 'trashed'])->name('trashed');
                Route::patch('/{id}/restore', [RulesAndRegulationController::class, 'restore'])->name('restore');
                Route::delete('/{id}/force-delete', [RulesAndRegulationController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý tiện ích
        Route::prefix('amenities')
            ->as('amenities.')
            ->group(function () {
                Route::get('/', [AmenityController::class, 'index'])->name('index');
                Route::get('/create', [AmenityController::class, 'create'])->name('create');
                Route::post('/store', [AmenityController::class, 'store'])->name('store');
                Route::get('{id}/show', [AmenityController::class, 'show'])->name('show');
                Route::get('{id}/edit', [AmenityController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [AmenityController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [AmenityController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [AmenityController::class, 'trashed'])->name('trashed');
                Route::patch('/{id}/restore', [AmenityController::class, 'restore'])->name('restore');
                Route::delete('{id}/force-delete', [AmenityController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý hệ thống
        Route::prefix('systems')
            ->as('systems.')
            ->group(function () {
                Route::get('/', [SystemController::class, 'index'])->name('index');
                Route::get('/create', [SystemController::class, 'create'])->name('create');
                Route::post('/store', [SystemController::class, 'store'])->name('store');
                Route::get('{id}/show', [SystemController::class, 'show'])->name('show');
                Route::get('{id}/edit', [SystemController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [SystemController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [SystemController::class, 'destroy'])->name('destroy');
            });

        // quản lý liên hệ
        Route::prefix('contacts')
            ->as('contacts.')
            ->group(function () {
                Route::get('/contacts', [ContactsController::class, 'index'])->name('index');
                Route::get('/contacts/{contact}', [ContactsController::class, 'show'])->name('show');
                Route::post('/contacts/{contact}/reply', [ContactsController::class, 'reply'])->name('reply');
            });

        // quản lý dịch vụ
        Route::prefix('services')
            ->as('services.')
            ->group(function () {
                Route::get('/', [ServiceController::class, 'index'])->name('index');
                Route::get('/create', [ServiceController::class, 'create'])->name('create');
                Route::post('/store', [ServiceController::class, 'store'])->name('store');
                Route::get('{id}/show', [ServiceController::class, 'show'])->name('show');
                Route::get('{id}/edit', [ServiceController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ServiceController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [ServiceController::class, 'destroy'])->name('destroy');
                Route::get('/trashed', [ServiceController::class, 'trashed'])->name('trashed');
                Route::patch('/{id}/restore', [ServiceController::class, 'restore'])->name('restore');
                Route::delete('/{id}/force-delete', [ServiceController::class, 'forceDelete'])->name('forceDelete');
            });

        // quản lý dịch vụ bổ sung
        Route::prefix('service_plus')
            ->as('service_plus.')
            ->group(function () {
                Route::get('/', [ServicePlusController::class, 'index'])->name('index');
                Route::get('/create', [ServicePlusController::class, 'create'])->name('create');
                Route::post('/store', [ServicePlusController::class, 'store'])->name('store');
                Route::get('{id}/show', [ServicePlusController::class, 'show'])->name('show');
                Route::get('{id}/edit', [ServicePlusController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [ServicePlusController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [ServicePlusController::class, 'destroy'])->name('destroy');
            });

        // quản lý tài khoản admin
        Route::prefix('admin_accounts')
            ->as('admin_accounts.')
            ->group(function () {
                Route::get('/', [AdminAccountController::class, 'index'])->name('index');
                Route::get('{id}/edit', [AdminAccountController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [AdminAccountController::class, 'update'])->name('update');
            });

        // quản lý khách hàng
        Route::prefix('customers')
            ->as('customers.')
            ->group(function () {
                Route::get('/', [CustomerController::class, 'index'])->name('index');
                Route::get('{id}/show', [CustomerController::class, 'show'])->name('show');
                Route::put('{id}/update-status', [CustomerController::class, 'updateStatus'])->name('update-status');
            });

        Route::resource('promotions', PromotionController::class); // Khuyến mãi
        Route::resource('roles', RoleController::class); // Vai trò
        Route::resource('abouts', AboutController::class); // Giới thiệu
        Route::resource('introductions', IntroductionController::class); // Thông tin giới thiệu
        Route::resource('policies', PolicyController::class); // Chính sách
        Route::resource('banners', BannerController::class); // Banner
        Route::resource('faqs', FaqController::class); // Câu hỏi thường gặp
        Route::resource('payments', PaymentController::class); // Thanh toán
        Route::resource('sale-room-types', SaleRoomTypeController::class); // Loại phòng giảm giá

        // thống kê admin
        Route::get('/admin/statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('admin.statistics');
    });

/*
|--------------------------------------------------------------------------
| Client
|--------------------------------------------------------------------------
*/

// trang chủ và phòng
Route::get('/', [HomeController::class, 'index'])->name('home'); // Trang chủ
Route::get('/room/{id}', [HomeController::class, 'show'])->name('room.details'); // Chi tiết phòng
Route::get('/room', [HomeController::class, 'room_view'])->name('room.view'); // Xem danh sách phòng

// thông tin
Route::get('/cau-hoi-thuong-gap', [HomeController::class, 'faqs'])->name('faqs'); // Câu hỏi thường gặp
Route::get('/dich-vu', [HomeController::class, 'services'])->name('services'); // Dịch vụ
Route::get('/chinh-sach', [HomeController::class, 'policies'])->name('policies'); // Chính sách
Route::get('/uu-dai', [ClientPromotionController::class, 'index'])->name('clients.promotions.index'); // Khuyến mãi
Route::get('/gioi-thieu', [HomeController::class, 'introductions'])->name('introductions'); // Giới thiệu
Route::get('/lien-he-voi-chung-toi', [HomeController::class, 'contacts'])->name('contacts'); // Liên hệ
Route::post('/lien-he-voi-chung-toi', [HomeController::class, 'send'])->name('contact.send'); // Gửi liên hệ

// quản lý đặt phòng phía client
Route::prefix('bookings')
    ->as('bookings.')
    ->group(function () {
        Route::get('/', [ClientBookingController::class, 'index'])->name('index');
        Route::get('/create', [ClientBookingController::class, 'create'])->name('create');
        Route::post('/confirm', [ClientBookingController::class, 'confirm'])->name('confirm');
        Route::post('/store', [ClientBookingController::class, 'store'])->name('store');
        Route::get('{id}/returnVnpay', [ClientBookingController::class, 'returnVnpay'])->name('return.vnpay'); // Xử lý trả về VNPay
        Route::get('{id}/show', [ClientBookingController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ClientBookingController::class, 'edit'])->name('edit');
        Route::put('{id}', [ClientBookingController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ClientBookingController::class, 'destroy'])->name('destroy');
        Route::post('/check-promotion', [ClientBookingController::class, 'checkPromotion'])->name('check-promotion');
        Route::get('/payment/callback', [ClientBookingController::class, 'paymentCallback'])->name('payment.callback');
        Route::get('/success', [ClientBookingController::class, 'success'])->name('success');
        Route::post('{id}/process-next-payment', [ClientBookingController::class, 'processNextPayment'])->name('process-next-payment');
    });

// danh sách thanh toán
Route::get('payments', [HomeController::class, 'paymentsList'])->name('payments.lists');

// quản lý hoàn tiền phía client
Route::prefix('refunds')
    ->group(function () {
        Route::post('/{booking}/request', [ClientRefundController::class, 'requestRefund'])->name('refunds.request');
        Route::get('/lists', [ClientRefundController::class, 'lists'])->name('refunds.lists');
    });

// quản lý đánh giá phía client (yêu cầu xác thực)
Route::middleware(['auth'])->group(function () {
    Route::get('/reviews', [ClientReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ClientReviewController::class, 'store'])->name('reviews.store');
});