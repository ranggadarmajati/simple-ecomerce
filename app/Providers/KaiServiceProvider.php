<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use App\Client\Kai;

class KaiServiceProvider extends ServiceProvider
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
       $this->app->singleton('echakids.kai', function ($app) {
           return new Kai(new HttpClient);
       });
   }

   /**
    * Get the services provided by the provider.
    *
    * @return array
    */
   public function provides()
   {
       return ['echakids.kai'];
   }
}
