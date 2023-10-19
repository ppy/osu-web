<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use DB;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class BroadcastableEventBase implements ShouldBroadcast
{
    /**
     * Broadcasts the event.
     *
     * @param bool $afterCommit true to broadcast after the current connection's transaction is committed, false to queue immediately.
     * @return void
     */
    public function broadcast(bool $afterCommit = false)
    {
        if ($afterCommit) {
            DB::afterCommit(fn () => event($this));
        } else {
            event($this);
        }
    }
}
