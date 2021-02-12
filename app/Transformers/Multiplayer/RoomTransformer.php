<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\Room;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;
use Carbon\Carbon;

class RoomTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'current_user_score',
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
            'category' => $room->category,
            'user_id' => $room->user_id,
            'starts_at' => json_time($room->starts_at),
            'ends_at' => json_time($room->ends_at),
            'max_attempts' => $room->max_attempts,
            'participant_count' => $room->participant_count,
            'channel_id' => $room->channel_id,
            'active' => Carbon::now()->between($room->starts_at, $room->ends_at),
        ];
    }

    public function includeCurrentUserScore(Room $room)
    {
        $user = auth()->user();

        if ($user === null) {
            return;
        }

        $score = UserScoreAggregate::lookupOrDefault($user, $room);

        return $this->item($score, new UserScoreAggregateTransformer());
    }

    public function includeHost(Room $room)
    {
        return $this->item(
            $room->host,
            new UserCompactTransformer()
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

        return $this->collection($users, new UserCompactTransformer());
    }

    public function includePlaylist(Room $room)
    {
        return $this->collection(
            $room->playlist,
            new PlaylistItemTransformer()
        );
    }

    public function includeScores(Room $room)
    {
        return $this->collection(
            $room->scores()->completed()->get(),
            new ScoreTransformer()
        );
    }
}
