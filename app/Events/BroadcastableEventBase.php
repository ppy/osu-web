<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use DB;
use Illuminate\Contracts\Broadcasting\Factory;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class BroadcastableEventBase implements ShouldBroadcast
{
    public function broadcast()
    {
        DB::afterCommit(fn () => app(Factory::class)->queue($this));
    }
}
