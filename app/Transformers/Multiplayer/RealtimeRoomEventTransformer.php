<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\RealtimeRoomEvent;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserTransformer;

class RealtimeRoomEventTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'user',
    ];

    public function transform(RealtimeRoomEvent $event)
    {
        return [
            'event_detail' => json_decode($event->event_detail),
            'event_type' => $event->event_type,
            'id' => $event->getKey(),
            'playlist_item_id' => $event->playlist_item_id,
            'timestamp' => json_time($event->created_at),
            'user_id' => $event->user_id,
        ];
    }

    public function includeUser(RealtimeRoomEvent $event)
    {
        if ($event->user) {
            return $this->item($event->user, new UserTransformer());
        }

        return null;
    }
}
