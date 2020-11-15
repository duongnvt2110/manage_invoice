<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Customer\CustomerRepository;
use App\Repository\Customer\CustomerRepositoryInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        app()->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
