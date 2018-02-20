<?php

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

        Event::listen(TransactionCommitted::class, function ($event) {
            resolve(TransactionStateManager::class)->commit($event->connection);
        });

        Event::listen(TransactionRolledBack::class, function ($event) {
            resolve(TransactionStateManager::class)->rollback($event->connection);
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
