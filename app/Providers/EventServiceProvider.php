<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\Listeners;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
    ];

    protected $subscribe = [
        Listeners\Fulfillments\GenericSubscribers::class,
        Listeners\Fulfillments\PaymentSubscribers::class,
        Listeners\Fulfillments\ValidationSubscribers::class,
    ];
}
