<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmap;
use App\Models\Notification;
use App\Models\UserNotificationOption;

class BeatmapsetDiscussionQualifiedProblem extends BeatmapsetDiscussionPostNotification
{
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::BEATMAPSET_MODDING;

    public function getListeningUserIds(): array
    {
        $beatmap = $this->beatmapsetDiscussionPost->beatmap;

        if ($beatmap === null) {
            $modes = $this->beatmapsetDiscussionPost->beatmapset->playmodes()->all();
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

        return $ids;
    }
}
