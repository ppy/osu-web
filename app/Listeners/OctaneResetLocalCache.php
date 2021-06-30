<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Listeners;

use App\Events\Fulfillments\ValidationFailedEvent;
use App\Traits\StoreNotifiable;

class OctaneResetLocalCache
{
    public function handle($event): void
    {
        app('chat-filters')->incrementResetTicker();
        app('groups')->incrementResetTicker();
    }
}

