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

namespace App\Transformers;

use App\Models\Chat\UserChannel;
use League\Fractal;

class UserChannelTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'channel',
        'user',
        'messages',
    ];

    public function transform(UserChannel $userChannel)
    {
        return [
            'user_id' => $userChannel->user_id,
            'channel_id' => $userChannel->channel_id,
            'last_read_id' => $userChannel->last_read_id,
        ];
    }

    public function includeChannel(UserChannel $userChannel)
    {
        return $this->item($userChannel->channel, new Chat\ChannelTransformer);
    }

    public function includeMessages(UserChannel $userChannel)
    {
        return $this->collection($userChannel->messages, new Chat\MessageTransformer);
    }

    public function includeUser(UserChannel $userChannel)
    {
        return $this->item($userChannel->user, new UserCompactTransformer);
    }
}
