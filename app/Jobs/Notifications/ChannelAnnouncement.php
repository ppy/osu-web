<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs\Notifications;

use App\Models\Chat\Message;
use App\Models\Notification;
use App\Models\User;

class ChannelAnnouncement extends BroadcastNotificationBase
{
    const DELIVERY_MODE_DEFAULTS = ['mail' => true, 'push' => true];

    protected $message;

    public static function getBaseKey(Notification $notification): string
    {
        return 'channel.announcement.announce';
    }

    public static function getMailLink(Notification $notification): string
    {
        return route('chat.index', ['channel_id' => $notification->notifiable_id]);
    }

    public function __construct(Message $message, User $source)
    {
        parent::__construct($source);

        $this->message = $message;
    }

    public function getDetails(): array
    {
        $channel = $this->message->channel;

        return [
            'channel_id' => $channel->getKey(),
            'name' => $channel->name,
            'title' => truncate($this->message->content, static::CONTENT_TRUNCATE),
            'type' => strtolower($channel->type),
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
