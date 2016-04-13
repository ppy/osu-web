<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Transformers\API\Chat;

use League\Fractal;
use App\Models\Chat\Message;

class MessageTransformer extends Fractal\TransformerAbstract
{
    public function transform(Message $message)
    {
        return [
            'message_id' => $message->message_id,
            'user_id' => $message->user_id,
            'channel_id' => $message->channel_id,
            'timestamp' => $message->timestamp->toDateTimeString(),
            'content' => $message->content,
            'sender' => [
                'username' => $message->user->username,
                'colour' => $message->user->user_colour,
            ],
        ];
    }
}
