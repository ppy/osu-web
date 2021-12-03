<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Chat;

use App\Models\Chat\Channel;
use App\Models\User;
use App\Transformers\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
    const CONVERSATION_INCLUDES = [
        'last_message_id',
        'users',
    ];

    const LISTING_INCLUDES = [
        'current_user_attributes',
        'last_read_id',
        ...self::CONVERSATION_INCLUDES,
    ];

    protected $availableIncludes = [
        'current_user_attributes',
        'last_message_id',
        'last_read_id', // deprecated
        'recent_messages',
        'users',
    ];

    private $user;

    public static function forUser(?User $user)
    {
        $transformer = new static();
        $transformer->user = $user;

        return $transformer;
    }

    public function transform(Channel $channel)
    {
        return [
            'channel_id' => $channel->channel_id,
            'description' => $channel->description,
            'icon' => $channel->displayIconFor($this->user),
            'moderated' => $channel->moderated,
            'name' => $channel->displayNameFor($this->user),
            'type' => $channel->type,
        ];
    }

    public function includeCurrentUserAttributes(Channel $channel)
    {
        return $this->primitive([
            'can_message' => $channel->canMessage($this->user),
            'can_message_error' => $channel->canMessageError($this->user),
            'last_read_id' => $channel->lastReadIdFor($this->user),
        ]);
    }

    public function includeLastMessageId(Channel $channel)
    {
        return $this->primitive($channel->last_message_id);
    }

    public function includeLastReadId(Channel $channel)
    {
        return $this->primitive($channel->lastReadIdFor($this->user));
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
        if ($channel->isPM()) {
            return $this->primitive($channel->userIds());
        }

        return $this->primitive([]);
    }
}
