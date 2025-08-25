<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\BookingController;

class CancelUnpaidBookings extends Command
{
    protected $signature = 'bookings:cancel-unpaid';
    protected $description = 'Kiểm tra và hủy các booking chưa thanh toán theo thời gian thực';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Bắt đầu kiểm tra booking chưa thanh toán theo thời gian thực tại ' . now());

        while (true) {
            $controller = new BookingController();
            $controller->cancelUnpaidBookings();
            sleep(60); // Kiểm tra 5p/lần
        }
    }
}
