<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\UserNotificationOption;

class NewsPostNew extends BroadcastNotificationBase
{
    const DELIVERY_MODE_DEFAULTS = ['mail' => false, 'push' => false];
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::NEWS_POST;

    public static function getMailLink(Notification $notification): string
    {
        return route('news.show', $notification->details['slug']);
    }

    public function __construct(protected NewsPost $newsPost)
    {
        parent::__construct();
    }

    public function getDetails(): array
    {
        return [
            'cover_url' => $this->newsPost->notificationCover(),
            'news_post_id' => $this->newsPost->getKey(),
            'series' => $this->newsPost->series(),
            'slug' => $this->newsPost->slug,
            'title' => $this->newsPost->title(),
        ];
    }

    public function getListeningUserIds(): array
    {
        $ids = [];

        $series = $this->newsPost->series();

        UserNotificationOption
            ::where(['name' => UserNotificationOption::NEWS_POST])
            ->whereNotNull('details')
            ->chunkById(1000, function ($options) use (&$ids, $series) {
                foreach ($options as $option) {
                    if (in_array($series, $option->getNewsPostSeries(), true)) {
                        $ids[] = $option->user_id;
                    }
                }
            });

        return $ids;
    }

    public function getNotifiable()
    {
        return $this->newsPost;
    }
}
