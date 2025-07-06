<?php

namespace App\Providers;

use App\Services\AddressServices;
use Illuminate\Support\ServiceProvider;

class AddressProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AddressServices::class,function(){
           return new AddressServices();
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
