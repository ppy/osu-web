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

use App\Models\Multiplayer\Room;
use App\Transformers\UserCompactTransformer;
use Carbon\Carbon;
use League\Fractal;

class RoomTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'host',
        'playlist',
        'recent_participants',
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

    public function includeRecentParticipants(Room $room)
    {
        $users = $room
            ->userHighScores()
            ->with('user')
            ->orderBy('updated_at', 'DESC')
            ->limit(50)
            ->get()
            ->pluck('user');

        return $this->collection($users, new UserCompactTransformer);
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
