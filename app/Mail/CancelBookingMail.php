<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelBookingMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;
    public $cancelledBy;

    public function __construct(Booking $booking, $cancelledBy = 'customer')
    {
        $this->booking = $booking;
        $this->cancelledBy = $cancelledBy;
    }

    public function build()
    {
        return $this->subject('Hủy Đặt Phòng và Hoàn Tiền Thành Công - Lumora Hotel')
            ->view('emails.cancel_booking')
            ->with([
                'booking' => $this->booking,
                'cancelledBy' => $this->cancelledBy,
            ]);
    }
}
