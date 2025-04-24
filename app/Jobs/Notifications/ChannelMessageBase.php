<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs\Notifications;

use App\Models\Chat\Message;
use App\Models\Notification;
use App\Models\User;

abstract class ChannelMessageBase extends BroadcastNotificationBase
{
    public static function getBaseKey(Notification $notification): string
    {
        return "channel.channel.{$notification->details['type']}";
    }

    public static function getMailLink(Notification $notification): string
    {
        return route('chat.index', ['channel_id' => $notification->notifiable_id]);
    }

    public function __construct(protected Message $message, User $source)
    {
        parent::__construct($source);
    }

    public function getDetails(): array
    {
        return [
            'title' => truncate($this->message->content, static::CONTENT_TRUNCATE),
            'type' => strtolower($this->message->channel->type),
            'cover_url' => $this->source->user_avatar,
        ];
    }

    public function getListeningUserIds(): array
    {
        return $this->message->channel->userIds();
    }

    public function getNotifiable()
    {
        return $this->message->channel;
    }
}
