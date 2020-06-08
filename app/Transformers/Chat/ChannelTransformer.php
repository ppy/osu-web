<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Chat;

use App\Models\Chat\Channel;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class ChannelTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'recent_messages',
        'users',
    ];

    public function transform(Channel $channel)
    {
        return [
            'channel_id' => $channel->channel_id,
            'name' => $channel->name,
            'description' => $channel->description,
            'type' => $channel->type,
        ];
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
                ->get();
        } else {
            $messages = [];
        }

        return $this->collection($messages, new MessageTransformer);
    }

    public function includeUsers(Channel $channel)
    {
        return $this->collection($channel->users()->get(), new UserCompactTransformer);
    }
}
