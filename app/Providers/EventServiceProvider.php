<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\Customer\OrderConfirmMail' => [
            'App\Listeners\Customer\SendOrderConfirmMail'
        ],
        'App\Events\Customer\CourierConfirm' => [
            'App\Listeners\Customer\SendCourierConfirm'
        ],
        'App\Events\Customer\OrderNew' => [
            'App\Listeners\Customer\SendOrderNew'
        ],
        'App\Events\Customer\PaymentConfirmation' => [
            'App\Listeners\Customer\SendPaymentConfirmationMail'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
