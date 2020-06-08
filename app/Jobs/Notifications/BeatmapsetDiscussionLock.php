<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Notification;

class BeatmapsetDiscussionLock extends BeatmapsetNotification
{
    public static function getMailText(Notification $notification): string
    {
        return trans("notifications.item.beatmapset.beatmapset_discussion.{$notification->name}", $notification->details);
    }
}
