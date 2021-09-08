<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Chat;

use App\Models\Chat\Message;
use App\Models\DeletedUser;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class MessageTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'sender',
        'uuid',
    ];

    public function transform($message)
    {
        return [
            'message_id' => $message->message_id,
            'sender_id' => $message->user_id,
            'channel_id' => $message->channel_id,
            'timestamp' => json_time($message->timestamp),
            'content' => $message->content,
            'is_action' => $message->is_action,
        ];
    }

    public function includeSender(Message $message)
    {
        return $this->item(
            $message->sender ?? (new DeletedUser()),
            new UserCompactTransformer()
        );
    }

    public function includeUuid(Message $message)
    {
        return $this->primitive($message->uuid);
    }
}
