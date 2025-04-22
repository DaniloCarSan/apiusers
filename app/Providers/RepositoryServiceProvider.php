<?php

namespace App\Providers;

use App\Business\Domain\Repositories\CustomerRepository as ICustomerRepository;
use App\Business\Domain\Repositories\UserRepository as IUserRepository;
use App\Business\Infra\Repositories\CustomerRepository;
use App\Business\Infra\Repositories\UserRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
