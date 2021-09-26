<?php

namespace App\Events\Customer;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderNew
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customer;
    public $detail_order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($customer, $detail_order)
    {
        $this->customer = $customer;
        $this->detail_order = $detail_order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
