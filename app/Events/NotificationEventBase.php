<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Events;

use App\Libraries\MorphMap;
use App\Models\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class NotificationEventBase implements ShouldBroadcast
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
