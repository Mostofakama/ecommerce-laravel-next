<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LocationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->singleton(HomePageServices::class,function(){
           return new HomePageServices();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
