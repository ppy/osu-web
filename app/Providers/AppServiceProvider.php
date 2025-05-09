<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Hashing\OsuBcryptHasher;
use App\Libraries\MorphMap;
use App\Libraries\OsuCookieJar;
use App\Libraries\OsuMessageSelector;
use App\Libraries\RateLimiter;
use App\Singletons;
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

class AppServiceProvider extends ServiceProvider
{
    const LOCAL_CACHE_SINGLETONS = [
        'chat-filters' => Singletons\ChatFilters::class,
        'countries' => Singletons\Countries::class,
        'groups' => Singletons\Groups::class,
        'layout-cache' => Singletons\LayoutCache::class,
        'medals' => Singletons\Medals::class,
        'smilies' => Singletons\Smilies::class,
        'tags' => Singletons\Tags::class,
        'user-cover-presets' => Singletons\UserCoverPresets::class,
    ];

    const SINGLETONS = [
        'OsuAuthorize' => Singletons\OsuAuthorize::class,
        'assets-manifest' => Singletons\AssetsManifest::class,
        'clean-html' => Singletons\CleanHTML::class,
        'ip2asn' => Singletons\Ip2Asn::class,
        'local-cache-manager' => Singletons\LocalCacheManager::class,
        'mods' => Singletons\Mods::class,
        'route-section' => Singletons\RouteSection::class,
        'score-pins' => Singletons\UserScorePins::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap(MorphMap::flippedMap());

        $GLOBALS['cfg'] = \Config::all();

        Queue::after(function (JobProcessed $event) {
            app('OsuAuthorize')->resetCache();
            app('local-cache-manager')->incrementResetTicker();

            datadog_increment(
                'queue.run',
                [
                    'job' => $event->job->payload()['data']['commandName'],
                    'queue' => $event->job->getQueue(),
                ]
            );
        });

        $this->app->make('translator')->setSelector(new OsuMessageSelector());

        app('url')->forceScheme(substr($GLOBALS['cfg']['app']['url'], 0, 5) === 'https' ? 'https' : 'http');

        Request::setTrustedProxies($GLOBALS['cfg']['trustedproxy']['proxies'], $GLOBALS['cfg']['trustedproxy']['headers']);

        // newest scribe tries to rename {modelName} parameters to {id}
        // but it kind of doesn't work with our route handlers.
        Scribe::normalizeEndpointUrlUsing(fn ($url) => $url);

        \Hash::extend('osubcrypt', fn () => new OsuBcryptHasher());
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

        $this->app->singleton('cookie', function ($app) {
            $config = $GLOBALS['cfg']['session'];

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
        }
    }
}
