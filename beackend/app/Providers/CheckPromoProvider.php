<?php

namespace App\Providers;

use App\Services\CheckPromoServices;
use Illuminate\Support\ServiceProvider;

class CheckPromoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->singleton(CheckPromoServices::class,function(){
            return new CheckPromoServices();
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
