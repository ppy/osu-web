<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmap;
use App\Models\Notification;
use App\Models\UserNotificationOption;

class BeatmapsetDisqualify extends BeatmapsetNotification
{
    public function getListeningUserIds(): array
    {
        $ids = parent::getListeningUserIds();

        $modes = $this->beatmapset->playmodes()->all();
        $modes = array_map(function ($modeInt) {
            return Beatmap::modeStr($modeInt);
        }, $modes);

        UserNotificationOption::where(['name' => Notification::BEATMAPSET_DISQUALIFY])
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
