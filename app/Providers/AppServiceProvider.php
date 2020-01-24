<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Hashing\OsuHashManager;
use App\Http\Middleware\RequireScopes;
use App\Http\Middleware\StartSession;
use App\Libraries\Groups;
use App\Libraries\MorphMap;
use App\Libraries\OsuAuthorize;
use App\Libraries\OsuCookieJar;
use App\Libraries\OsuMessageSelector;
use Datadog;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::morphMap(array_flip(MorphMap::MAP));

        Validator::extend('mixture', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[\d]/', $value) === 1 && preg_match('/[^\d\s]/', $value) === 1;
        });

        Queue::after(function (JobProcessed $event) {
            if (config('datadog-helper.enabled')) {
                Datadog::increment(
                    config('datadog-helper.prefix_web').'.queue.run',
                    1,
                    [
                        'job' => $event->job->resolveName(),
                        'queue' => $event->job->getQueue(),
                    ]
                );
            }
        });

        $this->app->make('translator')->setSelector(new OsuMessageSelector);
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

        $this->app->singleton('groups', function () {
            return new Groups;
        });

        $this->app->singleton('hash', function ($app) {
            return new OsuHashManager($app);
        });

        $this->app->singleton('hash.driver', function ($app) {
            return $app['hash']->driver();
        });

        $this->app->singleton('OsuAuthorize', function () {
            return new OsuAuthorize();
        });

        $this->app->singleton(RequireScopes::class, function () {
            return new RequireScopes;
        });

        $this->app->singleton('cookie', function ($app) {
            $config = $app->make('config')->get('session');

            return (new OsuCookieJar)->setDefaultPathAndDomain(
                $config['path'], $config['domain'], $config['secure'], $config['same_site'] ?? null
            );
        });

        // The middleware breaks without this. Not sure why.
        // Originally defined in Laravel's SessionServiceProvider.
        $this->app->singleton(StartSession::class);
    }
}
