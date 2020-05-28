<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Achievement;
use App\Models\User;

class UserAchievementUnlock extends BroadcastNotification
{
    private $user;

    public function __construct(Achievement $object, ?User $source)
    {
        parent::__construct($object, $source);

        $this->notifiable = $source;
        $this->user = $source;
    }

    public function getDetails(): array
    {
        return [
            'achievement_id' => $this->object->getKey(),
            'achievement_mode' => $this->object->mode,
            'cover_url' => $this->object->iconUrl(),
            'slug' => $this->object->slug,
            'title' => $this->object->name,
            'user_id' => $this->user->getKey(),
        ];
    }

    public function getListentingUserIds(): array
    {
        return [$this->user->getKey()];
    }

    public function getReceiverIds(): array
    {
        return $this->getListentingUserIds();
    }
}
