<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Libraries\TransactionStateManager;
use Event;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Support\ServiceProvider;

class TransactionStateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(TransactionBeginning::class, function ($event) {
            resolve(TransactionStateManager::class)->begin($event->connection);
        });

        Event::listen(TransactionCommitted::class, function ($_event) {
            resolve(TransactionStateManager::class)->commit();
        });

        Event::listen(TransactionRolledBack::class, function ($_event) {
            resolve(TransactionStateManager::class)->rollback();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Connection after commit tracker.

        // Laravel uses a singleton DatabaseManager that reuses connections
        // by name, so a singleton for tracking should be good enough.
        // The alternative is to override Connection and its subclasses.
        $this->app->singleton(TransactionStateManager::class, function ($app) {
            return new TransactionStateManager();
        });
    }
}
