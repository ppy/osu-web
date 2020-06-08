<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Chat\Message;
use App\Models\Notification;
use App\Models\User;

class ChannelMessage extends BroadcastNotificationBase
{
    protected $message;

    public static function getMailLink(Notification $notification): string
    {
        return route('chat.index', $notification->notifiable_id);
    }

    public static function getMailText(Notification $notification): string
    {
        return trans("notifications.item.channel.channel.pm.{$notification->name}_compact", $notification->details);
    }

    public function __construct(Message $message, User $source)
    {
        parent::__construct($source);

        $this->message = $message;
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
        return $this->message->channel->users()->pluck('user_id')->all();
    }

    public function getNotifiable()
    {
        return $this->message->channel;
    }
}
