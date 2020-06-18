<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Jobs\Notifications\BroadcastNotificationBase;
use App\Traits\NotificationQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

// Worker shim to handle jobs already pushed onto the queue,
// can be removed after these jobs are cleared from the queue.
class BroadcastNotification implements ShouldQueue
{
    use NotificationQueue, Queueable, SerializesModels;

    private $name;
    private $object;
    private $source;

    public function __construct($name, $object, $source = null)
    {
        $this->name = $name;
        $this->object = $object;
        $this->source = $source;
    }

    public function handle()
    {
        $className = BroadcastNotificationBase::getNotificationClass($this->name);
        $class = new $className($this->object, $this->source);
        $class->handle();
    }
}
