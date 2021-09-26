<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * This data for send mail.
     *
     * @var array
     */
    public $mail;
    public $detail_order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( array $mail, $detail_order )
    {
        $this->mail = $mail;
        $this->detail_order = $detail_order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view( 'mails.order_confirm', $this->mail, $this->detail_order   );
    }
}
