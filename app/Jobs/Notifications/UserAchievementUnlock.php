<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Achievement;
use App\Models\Notification;
use App\Models\User;

class UserAchievementUnlock extends BroadcastNotificationBase
{
    protected $achievement;

    public static function getMailLink(Notification $notification): string
    {
        return route('users.show', $notification->details['user_id']);
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
