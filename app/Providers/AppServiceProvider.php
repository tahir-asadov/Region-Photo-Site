<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use App\Http\Responses\RegisterResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);

        $this->app->singleton(\Laravel\Fortify\Contracts\RegisterResponse::class, RegisterResponse::class);
    }
}
