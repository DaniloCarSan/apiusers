<?php

namespace App\Providers;

use App\Business\Domain\Services\AuthService as IAuthService;
use App\Business\Infra\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class, AuthService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
