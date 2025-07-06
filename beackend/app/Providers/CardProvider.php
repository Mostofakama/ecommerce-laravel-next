<?php

namespace App\Providers;

use App\Services\CardServices;
use Illuminate\Support\ServiceProvider;

class CardProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CardServices::class,function(){
           return new CardServices();
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
