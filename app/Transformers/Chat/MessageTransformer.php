<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
