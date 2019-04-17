<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\Event;
use App\Transformers;
use League\Fractal;

class EventTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'user',
        'game',
    ];

    public function transform(Event $event)
    {
        return [
            'id' => $event->event_id,
            'detail' => $event->detail,
            'timestamp' => json_time($event->timestamp),
            'user_id' => $event->user_id,
        ];
    }

    public function includeUser(Event $event)
    {
        if ($event->user) {
            return $this->item($event->user, new Transformers\UserCompactTransformer);
        }
    }

    public function includeGame(Event $event)
    {
        if ($event->game) {
            return $this->item($event->game, new GameTransformer);
        }
    }
}
