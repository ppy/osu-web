<?php

namespace App\Providers;

use App\Libraries\UserVerification;
use Illuminate\Support\ServiceProvider;
use Route;

class AdditionalDuskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::get('/_dusk/verify', function () {
            return UserVerification::fromCurrentRequest()->markVerifiedAndRespond();
        });
    }
}
