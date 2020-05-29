<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmapset;
use App\Models\User;
use App\Models\UserNotificationOption;

abstract class BeatmapsetNotification extends BroadcastNotification
{
    public function __construct(Beatmapset $object, ?User $source = null)
    {
        parent::__construct($object, $source);
    }

    public function getDetails(): array
    {
        return [
            'title' => $this->object->title,
            'cover_url' => $this->object->coverURL('card'),
        ];
    }

    public function getListentingUserIds(): array
    {
        return static::filterUserIdsForNotificationOption(
            $this->getNotifiable()->watches()->pluck('user_id')->all(),
            UserNotificationOption::BEATMAPSET_MODDING
        );
    }
}
