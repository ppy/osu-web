<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Beatmapset;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;

abstract class BeatmapsetNotification extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::BEATMAPSET_MODDING;

    protected $beatmapset;

    public static function getMailLink(Notification $notification): string
    {
        return route('beatmapsets.show', $notification->notifiable_id);
    }

    /**
     * {@inheritdoc}
     */
    public static function shouldSendMail(Notification $notification, $watches, $time): bool
    {
        // skip the more 'generic notifications if they've already been sent and not known to be 'read'.
        if (static::getBaseKey($notification) === 'beatmapset.beatmapset_state') {
            $watch = $watches['beatmapsets'][$notification->notifiable_id] ?? null;
            if ($watch === null) {
                return false;
            }

            // make the model dirty so UserNotificationDigest job can batch update
            $watch->last_notified = $time;
        }

        return true;
    }

    public function __construct(Beatmapset $beatmapset, ?User $source = null)
    {
        parent::__construct($source);

        $this->beatmapset = $beatmapset;
    }

    public function getDetails(): array
    {
        return [
            'title' => $this->beatmapset->title,
            'title_unicode' => $this->beatmapset->title_unicode,
            'cover_url' => $this->beatmapset->coverURL('card'),
        ];
    }

    public function getListeningUserIds(): array
    {
        return $this->beatmapset->watches()->pluck('user_id')->all();
    }

    public function getNotifiable()
    {
        return $this->beatmapset;
    }
}
