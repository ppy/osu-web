<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Chat\Channel as ChatChannel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChatChannelEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $broadcastQueue;
    public $action;
    public $channel;
    public $user;

    public function __construct(ChatChannel $channel, User $user, string $action)
    {
        $this->broadcastQueue = config('osu.chat.queue_name');

        $this->action = $action;
        // TODO: don't seralize laravel model to skip lookup.
        $this->channel = $channel;
        $this->user = $user;
    }

    public function broadcastAs()
    {
        return "chat.channel.{$this->action}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("private:user:{$this->user->getKey()}");
    }

    public function broadcastWith()
    {
        // TODO: parting channel only needs channel id.
        return json_item($this->channel, ChannelTransformer::forUser($this->user), ['first_message_id', 'last_message_id', 'users']);
    }
}
