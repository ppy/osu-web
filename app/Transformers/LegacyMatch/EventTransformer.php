<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\LegacyMatch;

use App\Models\LegacyMatch\Event;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class EventTransformer extends TransformerAbstract
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
            return $this->item($event->user, new UserCompactTransformer());
        }
    }

    public function includeGame(Event $event)
    {
        if ($event->game) {
            return $this->item($event->game, new GameTransformer());
        }
    }
}
