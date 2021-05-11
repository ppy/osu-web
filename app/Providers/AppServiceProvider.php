<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Hashing\OsuHashManager;
use App\Libraries\ChatFilters;
use App\Libraries\Groups;
use App\Libraries\MorphMap;
use App\Libraries\OsuAuthorize;
use App\Libraries\OsuCookieJar;
use App\Libraries\OsuMessageSelector;
use App\Libraries\RouteSection;
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
            Datadog::increment(
                config('datadog-helper.prefix_web').'.queue.run',
                1,
                [
                    'job' => $event->job->resolveName(),
                    'queue' => $event->job->getQueue(),
                ]
            );
        });

        $this->app->make('translator')->setSelector(new OsuMessageSelector());

        app('url')->forceScheme(substr(config('app.url'), 0, 5) === 'https' ? 'https' : 'http');
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

        $this->app->singleton('chat-filters', function() {
            return new ChatFilters();
        });

        $this->app->singleton('groups', function () {
            return new Groups();
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

        $this->app->singleton('route-section', function () {
            return new RouteSection();
        });

        $this->app->singleton('cookie', function ($app) {
            $config = $app->make('config')->get('session');

            return (new OsuCookieJar())->setDefaultPathAndDomain(
                $config['path'],
                $config['domain'],
                $config['secure'],
                $config['same_site'] ?? null
            );
        });

        // This is needed for testing with Dusk.
        if ($this->app->environment('testing')) {
            $this->app->register('\App\Providers\AdditionalDuskServiceProvider');
        }
    }
}
