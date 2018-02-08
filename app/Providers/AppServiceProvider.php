<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Providers;

use App\Http\Middleware\StartSession;
use App\Libraries\OsuAuthorize;
use Datadog;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\ServiceProvider;
use Queue;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('mixture', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[\d]/', $value) === 1 && preg_match('/[^\d\s]/', $value) === 1;
        });

        Queue::after(function (JobProcessed $event) {
            if (config('datadog-helper.enabled')) {
                Datadog::increment(config('datadog-helper.prefix_web').'.queue.run', 1, ['queue' => $event->job->getQueue()]);
            }
        });
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'App\Services\Registrar'
        );

        $this->app->bind('hash', 'App\Hashing\OsuHasher');

        $this->app->singleton('OsuAuthorize', function () {
            return new OsuAuthorize();
        });

        // The middleware breaks without this. Not sure why.
        // Originally defined in Laravel's SessionServiceProvider.
        $this->app->singleton(StartSession::class);
    }
}
