<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs\Notifications;

use App\Libraries\User\UsernamesForDbLookup;
use App\Models\Chat\UserChannel;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotificationOption;

class ChannelMention extends ChannelMessageBase
{
    const CONTENT_TRUNCATE = 200;
    const NOTIFICATION_OPTION_NAME = UserNotificationOption::CHANNEL_MENTION;

    public static function getMailGroupingKey(Notification $notification): string
    {
        $base = parent::getMailGroupingKey($notification);

        return "{$base}-{$notification->notifiable_id}-{$notification->source_user_id}";
    }

    public function getDetails(): array
    {
        $channel = $this->message->channel;

        return [
            ...parent::getDetails(),
            'message_id' => $this->message->getKey(),
            'name' => $channel->name,
        ];
    }

    public function getListeningUserIds(): array
    {
        $username = $this->message->mention();
        $usernamesForDbLookup = UsernamesForDbLookup::make($username, trimPrefix: true);

        $userId = User::whereIn('username', $usernamesForDbLookup)->pluck('user_id')->first();

        return UserChannel
            ::where('channel_id', $this->message->channel_id)
            ->where('user_id', $userId)
            ->pluck('user_id')
            ->all();
    }
}
