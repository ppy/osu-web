<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\RealtimeRoomEvent;
use App\Transformers\TransformerAbstract;

class RealtimeRoomEventTransformer extends TransformerAbstract
{
    public function transform(RealtimeRoomEvent $event)
    {
        return [
            'created_at' => json_time($event->created_at),
            'event_detail' => $event->event_detail,
            'event_type' => $event->event_type,
            'id' => $event->getKey(),
            'playlist_item_id' => $event->playlist_item_id,
            'user_id' => $event->user_id,
        ];
    }
}
