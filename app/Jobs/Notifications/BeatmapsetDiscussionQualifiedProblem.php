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

        UserNotificationOption
            ::where(['name' => Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM])
            ->whereNotNull('details')
            ->chunkById(1000, function ($options) use (&$ids, $modes) {
                foreach ($options as $option) {
                    if (count(array_intersect($option->details['modes'] ?? [], $modes)) > 0) {
                        $ids[] = $option->user_id;
                    }
                }
            });

        return $ids;
    }
}
