<?php

namespace App\Providers;

use App\Libraries\TransactionState;
use App\Libraries\TransactionStateManager;
use Event;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Support\ServiceProvider;
use Log;

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
            Log::debug($this->eventInfo($event));
            resolve('TransactionState')->begin($event->connection);
        });

        Event::listen(TransactionCommitted::class, function ($event) {
            Log::debug($this->eventInfo($event));
            resolve('TransactionState')->commit($event->connection);
        });

        Event::listen(TransactionRolledBack::class, function ($event) {
            Log::debug($this->eventInfo($event));
            resolve('TransactionState')->rollback($event->connection);
        });
    }

    private function eventInfo($event)
    {
        return [
            'className' => get_class($event),
            'connectionName' => $event->connectionName,
            'transactionLevel' => $event->connection->transactionLevel(),
        ];
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
        $this->app->singleton('TransactionState', function ($app) {
            return new TransactionStateManager();
        });
    }
}
