<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Override default login response behavior
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    public function boot(): void
    {
        //
    }
}
