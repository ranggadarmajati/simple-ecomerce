<?php
namespace App\Listeners\Customer;

use App\Mail\CourierConfirm;
use Illuminate\Support\Facades\Mail;
use App\Events\Customer\CourierConfirm as CourierConfirmMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCourierConfirm
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderConfirm  $event
     * @return void
     */
    public function handle(CourierConfirmMail $event)
    {
        $detail_order = $event->detail_order;
        // dd($detail_order);
        $mail = [
            "name" => $event->customer->customer
            , "email" => $event->customer->email
            , "order_no" => $event->customer->order_no
            , "courier" => $event->customer->courier
            , "package" => $event->customer->package
            , "tracking_number" => $event->customer->tracking_number
        ];

        Mail::to( $mail["email"] )->send( new CourierConfirm( $mail, $detail_order ) );
    }
}