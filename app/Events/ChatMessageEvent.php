<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Chat\Message;
use App\Transformers\Chat\MessageTransformer;
use App\Transformers\UserCompactTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ChatMessageEvent implements ShouldBroadcastNow
{
    public function __construct(public Message $message)
    {
    }

    public function broadcastAs()
    {
        return 'chat.message.new';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return array_map(function ($userId) {
            return new Channel("private:user:{$userId}");
        }, $this->message->channel->activeUserIds());
    }

    public function broadcastWith()
    {
        return [
            'messages' => json_collection([$this->message], new MessageTransformer()),
            'users' => json_collection([$this->message->sender], new UserCompactTransformer()),
        ];
    }
}
