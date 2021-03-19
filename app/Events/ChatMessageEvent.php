<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Chat\Message;
use App\Models\User;
use App\Transformers\Chat\MessageTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChatMessageEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $broadcastQueue;
    public $message;
    public $sender;

    // TODO: just get sender from message?
    public function __construct(Message $message, User $sender)
    {
        // TODO: different queue? conditional queue?
        $this->broadcastQueue = config('osu.notification.queue_name');

        // TODO: avoid serializing so handle doesn't need to perform queries to deserialize.
        $this->message = $message;
        $this->sender = $sender;
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
        if ($this->message->channel->isPublic()) {
            $userIds = array_diff($this->message->channel->userIds(), [$this->sender->getKey()]);

            return array_map(function ($userId) {
                return new Channel("private:user:{$userId}");
            }, $userIds);
        } else {
            $userId = $this->message->channel->pmTargetFor($this->sender)->getKey();

            return new Channel("private:user:{$userId}");
        }
    }

    public function broadcastWith()
    {
        return json_item($this->message, new MessageTransformer());
    }
}
