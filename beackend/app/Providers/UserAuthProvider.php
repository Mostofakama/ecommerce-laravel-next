<?php

namespace App\Providers;

use App\Services\UserAuthServices;
use Illuminate\Support\ServiceProvider;

class UserAuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserAuthServices::class,function(){
           return new UserAuthServices();
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
