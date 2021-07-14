<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Events;

use App\Models\Chat\Channel as ChatChannel;
use App\Models\User;
use App\Transformers\Chat\ChannelTransformer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ChatChannelEvent implements ShouldBroadcastNow
{
    public function __construct(public ChatChannel $channel, public User $user, public string $action)
    {
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
