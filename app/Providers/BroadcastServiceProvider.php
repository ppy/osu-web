<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Libraries\RedisBroadcaster;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot(BroadcastManager $broadcastManager)
    {
        $broadcastManager->extend('redis', function ($app, array $config) {
            return new RedisBroadcaster(
                $this->app->make('redis'),
                $config['connection'] ?? null,
                $this->app['config']->get('database.redis.options.prefix', '')
            );
        });
    }
}
