<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmap;
use App\Models\Notification;
use App\Models\UserNotificationOption;

class BeatmapsetDisqualify extends BeatmapsetNotification
{
    public function getListentingUserIds(): array
    {
        $modes = $this->object->playmodes()->all();
        $modes = array_map(function ($modeInt) {
            return Beatmap::modeStr($modeInt);
        }, $modes);

        $notificationOptions = UserNotificationOption
            ::where(['name' => Notification::BEATMAPSET_DISQUALIFY])
            ->whereNotNull('details')
            ->get();

        $ids = [];

        foreach ($notificationOptions as $notificationOption) {
            if (count(array_intersect($notificationOption->details['modes'] ?? [], $modes)) > 0) {
                $ids[] = $notificationOption->user_id;
            }
        }

        $ids = static::filterUserIdsForNotificationOption(
            $ids,
            UserNotificationOption::BEATMAPSET_MODDING
        );

        return array_merge($ids, static::beatmapsetWatcherUserIds($this->object));
    }
}
