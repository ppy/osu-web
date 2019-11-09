<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\Chat;

use App\Models\DeletedUser;
use App\Transformers\UserCompactTransformer;
use League\Fractal;

class MessageTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'sender',
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

    public function includeSender($message)
    {
        return $this->item(
            $message->sender ?? (new DeletedUser),
            new UserCompactTransformer
        );
    }
}
