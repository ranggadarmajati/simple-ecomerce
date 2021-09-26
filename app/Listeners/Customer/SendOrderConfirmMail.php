<?php

namespace App\Listeners\Customer;

use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;
use App\Events\Customer\OrderConfirmMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmMail
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
    public function handle(OrderConfirmMail $event)
    {
        $detail_order = $event->detail_order;
        // dd($detail_order);
        $mail = [
            "name" => $event->customer->customer
            , "email" => $event->customer->email
            , "order_no" => $event->customer->order_no
        ];

        Mail::to( $mail["email"] )->send( new OrderConfirm( $mail, $detail_order ) );
    }
}
