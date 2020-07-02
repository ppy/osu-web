<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        })->middleware('web');
    }
}
