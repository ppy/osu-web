<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Notifications;

use App\Models\Chat\Message;
use App\Models\User;

class ChannelMessage extends NotificationBase
{
    public function __construct(Message $object, ?User $source)
    {
        parent::__construct($object, $source);

        $this->notifiable = $this->object->channel;
        // TODO: null check?
        // $channel = Channel::findOrFail($this->object->channel_id);
    }

    public function getDetails(): array
    {
        return [
            'title' => truncate($this->object->content, static::CONTENT_TRUNCATE),
            'type' => strtolower($this->object->channel->type),
            'cover_url' => $this->source->user_avatar,
        ];
    }

    public function getListentingUserIds(): array
    {
        return $this->object->channel->users()->pluck('user_id')->all();
    }
}
