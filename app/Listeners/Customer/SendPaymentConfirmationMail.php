<?php

namespace App\Listeners\Customer;

use DB;
use App\User;
use App\Mail\PaymentConfirmation;
use App\Events\Customer\PaymentConfirmation as PaymentConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPaymentConfirmationMail
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
     * @param  PaymentConfirmation  $event
     * @return void
     */
    public function handle(PaymentConfirmationMail $event)
    {
        $email = 'rangga.android69@gmail.com';
        $detail_order = $event->detail_order;
        $order_no = $event->detail_order[0]->order_no;
        $name = $event->customer->first_name.' '.$event->customer->last_name;
        $mail = [
            "name" => $name
            , "email" => $email
            , "order_no" => $order_no
        ];
        
        $admin = \DB::table('users')
                ->select('users.*')
                ->join('role_users', 'users.id', '=', 'role_users.user_id')
                ->where('role_users.role_id', 1)
                ->get();
        foreach ($admin as $item_admin) {
            // Mail::to( $item_admin->email )->send( new PaymentConfirmation( $mail, $detail_order ), function($mail) use($subject){
            //     $mail->subject($subject);
            // } );
        $email = $item_admin->email;
        $subject = "Konfirmasi Pembayaran No Order: ".$order_no;
        Mail::send('mails.payment_confirmation', ['mail' => $mail, 'detail_order' => $detail_order],
            function($mails) use ($email, $name, $subject){
                $mails->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mails->to($email, $name);
                $mails->subject($subject);
            });
        }
    }
}
