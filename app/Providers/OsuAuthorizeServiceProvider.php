<?php

namespace App\Providers;

use App\Libraries\Authorize;
use Illuminate\Support\ServiceProvider;

class OsuAuthorizeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('osu-authorize', function () {
            return new Authorize();
        });
    }
}
