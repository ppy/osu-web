<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Events\BroadcastableEventBase;

class BroadcastsPendingForTests
{
    private $pending = [];

    public function add(BroadcastableEventBase $event)
    {
        $className = get_class($event);
        $this->pending[$className][] = $event;
    }

    public function dispatched(string $name, ?callable $callback = null)
    {
        return array_filter($this->pending[$name] ?? [], $callback);
    }

    public function reset()
    {
        $this->pending = [];
    }
}
