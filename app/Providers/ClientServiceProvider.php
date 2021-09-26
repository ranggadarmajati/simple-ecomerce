<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use App\Client\Client;

class ClientServiceProvider extends ServiceProvider
{
    /**
    * {@inheritDoc}
    */
   protected $defer = true;

   /**
    * Bootstrap the application services.
    *
    * @return void
    */
   public function boot()
   {
       //
   }

   /**
    * Register the application services.
    *
    * @return void
    */
   public function register()
   {
       $this->app->singleton('bri.client', function ($app) {
           return new Client(new HttpClient);
       });
   }

   /**
    * Get the services provided by the provider.
    *
    * @return array
    */
   public function provides()
   {
       return ['bri.client'];
   }
}
