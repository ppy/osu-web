<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\Room;
use App\Transformers\UserCompactTransformer;
use Carbon\Carbon;
use League\Fractal;

class RoomTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'host',
        'playlist',
        'scores',
    ];

    public function transform(Room $room)
    {
        return [
            'id' => $room->id,
            'name' => $room->name,
            'user_id' => $room->user_id,
            'starts_at' => json_time($room->starts_at),
            'ends_at' => json_time($room->ends_at),
            'max_attempts' => $room->max_attempts,
            'participant_count' => $room->participant_count,
            'channel_id' => $room->channel_id,
            'active' => Carbon::now()->between($room->starts_at, $room->ends_at),
        ];
    }

    public function includeHost(Room $room)
    {
        return $this->item(
            $room->host,
            new UserCompactTransformer
        );
    }

    public function includePlaylist(Room $room)
    {
        return $this->collection(
            $room->playlist,
            new PlaylistItemTransformer
        );
    }

    public function includeScores(Room $room)
    {
        return $this->collection(
            $room->scores()->completed()->get(),
            new RoomScoreTransformer
        );
    }
}
