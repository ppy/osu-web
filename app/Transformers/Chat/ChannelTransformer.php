<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Chat;

use App\Models\Chat\Channel;
use App\Transformers\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'first_message_id',
        'last_message_id',
        'recent_messages',
        'users',
    ];

    public function transform(Channel $channel)
    {
        return [
            'channel_id' => $channel->channel_id,
            'description' => $channel->description,
            'moderated' => $channel->moderated,
            'name' => $channel->name,
            'type' => $channel->type,
        ];
    }

    public function includeFirstMessageId(Channel $channel)
    {
        return $this->primitive($channel->messages()->select('message_id')->orderBy('message_id')->first()->message_id ?? null);
    }

    public function includeLastMessageId(Channel $channel)
    {
        return $this->primitive($channel->messages()->select('message_id')->last()->message_id ?? null);
    }

    public function includeRecentMessages(Channel $channel)
    {
        if ($channel->exists) {
            $messages = $channel
                ->filteredMessages()
                // assumes sender will be included by the Message transformer
                ->with('sender')
                ->orderBy('message_id', 'desc')
                ->limit(50)
                ->get()
                ->reverse();
        } else {
            $messages = [];
        }

        return $this->collection($messages, new MessageTransformer());
    }

    public function includeUsers(Channel $channel)
    {
        return $this->primitive($channel->userChannels()->pluck('user_id'));
    }
}
