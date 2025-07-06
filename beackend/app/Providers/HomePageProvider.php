<?php

namespace App\Providers;

use App\Services\HomePageServices;
use Illuminate\Support\ServiceProvider;

class HomePageProvider extends ServiceProvider
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
