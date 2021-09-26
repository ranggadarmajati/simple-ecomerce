<?php

namespace App\Console\Commands;

use DB;
use App\Courier;
use App\Transaction;
use App\CourierDestination;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class cronDeleteTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execution:destroyorder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy Transaction if transaction out of date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $current_date = date('Y-m-d');
        $q = DB::table('order_confirm_view')
            ->where('exp_transaction', $current_date)
            ->whereNull('transfer_date')
            ->get();
        
        foreach ($q as $trans) {
            $name = $trans->customer;
            $email = $trans->email;
            $order_no = $trans->order_no;
            $transaction_date = $trans->transaction_date;
            $mail = [
                  "name" => $name
                , "email" => $email
                , "order_no" => $order_no
                , "transaction_date" => $transaction_date
            ];
            $subject = "Reject/Cancel Order dengan No Order: ".$order_no;
            Mail::send('mails.reject_order', ['mail' => $mail],
                function($mails) use ($email, $name, $subject){
                    $mails->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mails->to($email, $name);
                    $mails->subject($subject);
            });

            $trans_delete = Transaction::findOrfail($trans->transaction_id);
            $courier_delete = Courier::where('transaction_id', $trans->transaction_id)->first();
            $cdestination = CourierDestination::where('courier_id', $courier_delete->id)->first();
            $stesp1 = $cdestination->delete();
            if ($stesp1) {
                $step2 = $courier_delete->delete();
                if ($step2) {
                    $trans_delete->delete();
                }
            }
        }
    }
}
