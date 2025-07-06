<?php

namespace App\Providers;

use App\Services\OrderServices;
use Illuminate\Support\ServiceProvider;

class OrderProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->singleton(OrderServices::class,function(){
           return new OrderServices();
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
