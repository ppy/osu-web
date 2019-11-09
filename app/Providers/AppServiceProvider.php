<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Providers;

use App\Hashing\OsuHashManager;
use App\Http\Middleware\RequireScopes;
use App\Http\Middleware\StartSession;
use App\Libraries\MorphMap;
use App\Libraries\OsuAuthorize;
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

        // The middleware breaks without this. Not sure why.
        // Originally defined in Laravel's SessionServiceProvider.
        $this->app->singleton(StartSession::class);
    }
}
