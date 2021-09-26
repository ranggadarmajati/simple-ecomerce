<?php

namespace App\Listeners\Customer;

use DB;
use App\User;
use App\Mail\OrderNew;
use App\Events\Customer\OrderNew as OrderNewMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderNew
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
     * @param  OrderNew  $event
     * @return void
     */
    public function handle(OrderNewMail $event)
    {
        $email = 'rangga.android69@gmail.com';
        $detail_order = $event->detail_order;
        $order_no = $event->detail_order[0]->order_no;
        $name = $event->customer->first_name.' '.$event->customer->last_name;
        $mail = [
            "name" => $event->customer->first_name.' '.$event->customer->last_name
            , "email" => $email
            , "order_no" => $order_no
        ];
        $admin = \DB::table('users')
                ->select('users.*')
                ->join('role_users', 'users.id', '=', 'role_users.user_id')
                ->where('role_users.role_id', 1)
                ->get();

        foreach ($admin as $item_admin) {
            // Mail::to( $item_admin->email )->send( new OrderNew( $mail, $detail_order ) );
            $email = $item_admin->email;
            $subject = "Order Baru dengan Order No :".$order_no;
            Mail::send('mails.order_new', ['mail' => $mail, 'detail_order' => $detail_order],
                function($mails) use ($email, $name, $subject){
                    $mails->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mails->to($email, $name);
                    $mails->subject($subject);
            });
        }
    }
}
