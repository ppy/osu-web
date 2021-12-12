<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\GraphQL\Providers\ComplexityProvider;
use App\GraphQL\Providers\ResolverProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Events\ManipulateAST;
use Nuwave\Lighthouse\Support\Contracts\ProvidesResolver;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        // Registers GraphQL performance tracing
        if ($this->app->environment('local')) {
            $this->app->register('\Nuwave\Lighthouse\Tracing\TracingServiceProvider');
        }

        $dispatcher->listen(
            ManipulateAST::class,
            [ComplexityProvider::class, 'handleManipulateAST']
        );
    }

    /**
     * Registers the custom default resolver
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProvidesResolver::class, ResolverProvider::class);
    }
}
