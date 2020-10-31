<?php

namespace App\Providers;

use App\LoanApplication;
use Illuminate\Support\ServiceProvider;
use App\User;
use App\Observers\UserObserver;
use App\Observers\LoanApplicationObserver;

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
        //
        User::observe(UserObserver::class);
        LoanApplication::observe(LoanApplicationObserver::class);
    }
}
