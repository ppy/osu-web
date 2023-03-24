<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Hashing\OsuHashManager;
use App\Libraries\AssetsManifest;
use App\Libraries\BroadcastsPendingForTests;
use App\Libraries\ChatFilters;
use App\Libraries\CleanHTML;
use App\Libraries\Groups;
use App\Libraries\Ip2Asn;
use App\Libraries\LayoutCache;
use App\Libraries\LocalCacheManager;
use App\Libraries\Medals;
use App\Libraries\Mods;
use App\Libraries\MorphMap;
use App\Libraries\OsuAuthorize;
use App\Libraries\OsuCookieJar;
use App\Libraries\OsuMessageSelector;
use App\Libraries\RateLimiter;
use App\Libraries\RouteSection;
use App\Libraries\User\ScorePins;
use Datadog;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\ServiceProvider;
use Knuckles\Scribe\Scribe;
use Laravel\Octane\Contracts\DispatchesTasks;
use Laravel\Octane\SequentialTaskDispatcher;
use Laravel\Octane\Swoole\SwooleTaskDispatcher;
use Queue;
use Swoole\Http\Server;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    const LOCAL_CACHE_SINGLETONS = [
        'chat-filters' => ChatFilters::class,
        'groups' => Groups::class,
        'layout-cache' => LayoutCache::class,
        'medals' => Medals::class,
    ];

    const SINGLETONS = [
        'OsuAuthorize' => OsuAuthorize::class,
        'assets-manifest' => AssetsManifest::class,
        'clean-html' => CleanHTML::class,
        'ip2asn' => Ip2Asn::class,
        'local-cache-manager' => LocalCacheManager::class,
        'mods' => Mods::class,
        'route-section' => RouteSection::class,
        'score-pins' => ScorePins::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(MorphMap::flippedMap());

        Validator::extend('mixture', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[\d]/', $value) === 1 && preg_match('/[^\d\s]/', $value) === 1;
        });

        Queue::after(function (JobProcessed $event) {
            app('OsuAuthorize')->resetCache();
            app('local-cache-manager')->incrementResetTicker();

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

        Request::setTrustedProxies(config('trustedproxy.proxies'), config('trustedproxy.headers'));

        // newest scribe tries to rename {modelName} parameters to {id}
        // but it kind of doesn't work with our route handlers.
        Scribe::normalizeEndpointUrlUsing(fn ($url) => $url);
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application.
     *
     * @return void
     */
    public function register()
    {
        foreach (array_merge(static::SINGLETONS, static::LOCAL_CACHE_SINGLETONS) as $name => $class) {
            $this->app->singleton($name, fn () => new $class());
        }
        $localCacheManager = app('local-cache-manager');
        foreach (static::LOCAL_CACHE_SINGLETONS as $name => $_class) {
            $localCacheManager->registerSingleton(app($name));
        }

        $this->app->singleton('hash', function ($app) {
            return new OsuHashManager($app);
        });

        $this->app->singleton('hash.driver', function ($app) {
            return $app['hash']->driver();
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

        $this->app->singleton(RateLimiter::class, function ($app) {
            return new RateLimiter($app->make('cache')->driver(
                $app['config']->get('cache.limiter')
            ));
        });

        // pre-bind to avoid SwooleHttpTaskDispatcher and fallback when not running in a swoole context.
        $this->app->bind(
            DispatchesTasks::class,
            fn ($app) => $app->bound(Server::class) ? new SwooleTaskDispatcher() : new SequentialTaskDispatcher()
        );

        $env = $this->app->environment();
        if ($env === 'testing' || $env === 'dusk.local') {
            // This is needed for testing with Dusk.
            $this->app->register(AdditionalDuskServiceProvider::class);

            // This is for testing after commit broadcastable events.
            $this->app->singleton(BroadcastsPendingForTests::class, fn () => new BroadcastsPendingForTests());
        }
    }
}
