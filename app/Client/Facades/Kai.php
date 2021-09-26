<?php

namespace App\Client\Facades;

use Illuminate\Support\Facades\Facade;

class Kai extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'echakids.kai';
    }
}
