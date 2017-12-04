<?php

namespace App\Providers;

use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRollback;
use Illuminate\Support\ServiceProvider;
use Event;

class AfterCommitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(TransactionCommitted::class, function ($event) {
            \Log::debug($this->eventInfo($event));
        });

        Event::listen(TransactionRollback::class, function ($event) {
            \Log::debug($this->eventInfo($event));
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
        //
    }
}
