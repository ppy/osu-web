<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Notifications;

use App\Models\Beatmap;
use App\Models\Notification;
use App\Models\UserNotificationOption;

class BeatmapsetDiscussionPostNew extends BeatmapsetNotification
{
    public function getReceiverIds(): array
    {
        $beatmap = $this->object->beatmap;

        if ($beatmap === null) {
            $modes = $this->object->beatmapset->playmodes()->all();
        } else {
            $modes = [$beatmap->playmode];
        }

        $modes = array_map(function ($modeInt) {
            return Beatmap::modeStr($modeInt);
        }, $modes);

        $ids = [];

        $notificationOptions = UserNotificationOption
            ::where(['name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM])
            ->whereNotNull('details')
            ->get();

        foreach ($notificationOptions as $notificationOption) {
            if (count(array_intersect($notificationOption->details['modes'] ?? [], $modes)) > 0) {
                $ids[] = $notificationOption->user_id;
            }
        }

        return static::filterUserIdsForNotificationOption(
            $ids,
            UserNotificationOption::BEATMAPSET_MODDING
        );
    }
}
