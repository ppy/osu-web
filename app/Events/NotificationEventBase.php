<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Libraries\MorphMap;
use App\Models\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class NotificationEventBase extends BroadcastableEventBase implements ShouldBroadcast
{
    public $broadcastQueue;

    public static function generateChannelName($notifiable, $subtype)
    {
        return 'new:'.
            MorphMap::getType($notifiable).
            ':'.
            $notifiable->getKey().
            (in_array($subtype, Notification::SUBTYPES, true) ? ":{$subtype}" : '');
    }

    public function __construct()
    {
        $this->broadcastQueue = config('osu.notification.queue_name');
    }
}
