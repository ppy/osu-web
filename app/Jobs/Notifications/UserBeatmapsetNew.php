<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmapset;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\UserNotificationOption;

class UserBeatmapsetNew extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::MAPPING;

    protected $beatmapset;

    public static function getMailLink(Notification $notification): string
    {
        return route('beatmapsets.show', $notification->details['beatmapset_id']);
    }

    public function __construct(Beatmapset $beatmapset)
    {
        parent::__construct($beatmapset->user);

        $this->beatmapset = $beatmapset;
    }

    public function getDetails(): array
    {
        return [
            'beatmapset_id' => $this->beatmapset->getKey(),
            'title' => $this->beatmapset->title,
            'title_unicode' => $this->beatmapset->title_unicode,
            'cover_url' => $this->beatmapset->coverURL('card'),
        ];
    }

    public function getListeningUserIds(): array
    {
        return Follow::whereNotifiable($this->beatmapset->user)
            ->where(['subtype' => 'mapping'])
            ->pluck('user_id')
            ->all();
    }

    public function getNotifiable()
    {
        return $this->beatmapset->user;
    }
}
