<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

    public function boot()
    {
        Passport::tokensExpireIn(Carbon::now()->addDays(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addMonths(3));

        if ($path = config('services.passport.path')) {
            Passport::keyPath($path);
        }

        Passport::routes();
    }
}
