<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Achievement;
use App\Models\Notification;
use App\Models\User;

class UserAchievementUnlock extends BroadcastNotificationBase
{
    const NOTIFICATION_OPTION_NAME = Notification::USER_ACHIEVEMENT_UNLOCK;

    protected $achievement;

    public static function getMailGroupingKey(Notification $notification): string
    {
        $base = parent::getMailGroupingKey($notification);

        return "{$base}-{$notification->details['achievement_id']}-{$notification->source_user_id}";
    }

    public static function getMailLink(Notification $notification): string
    {
        return route('users.show', [
            'mode' => $notification->details['achievement_mode'] ?? null, // might not be set in old notifications.
            'user' => $notification->details['user_id'],
        ]).'#medals';
    }

    public function __construct(Achievement $achievement, User $source)
    {
        parent::__construct($source);

        $this->achievement = $achievement;
    }

    public function getDetails(): array
    {
        return [
            'achievement_id' => $this->achievement->getKey(),
            'achievement_mode' => $this->achievement->mode,
            'cover_url' => $this->achievement->iconUrl(),
            'slug' => $this->achievement->slug,
            'title' => $this->achievement->name,
            'user_id' => $this->source->getKey(),
        ];
    }

    public function getListeningUserIds(): array
    {
        return [$this->source->getKey()];
    }

    public function getNotifiable()
    {
        return $this->source;
    }

    public function getReceiverIds(): array
    {
        return $this->getListeningUserIds();
    }
}
