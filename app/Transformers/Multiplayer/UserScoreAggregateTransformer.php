<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\Score;
use App\Models\Multiplayer\UserScoreAggregate;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class UserScoreAggregateTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'playlist_item_attempts',
        'position',
        'user',
    ];

    public function transform(UserScoreAggregate $score)
    {
        return [
            'accuracy' => $score->averageAccuracy(),
            'attempts' => $score->attempts,
            'completed' => $score->completed,
            'pp' => $score->averagePp(),
            'room_id' => $score->room_id,
            'total_score' => $score->total_score,
            'user_id' => $score->user_id,
        ];
    }

    public function includePlaylistItemAttempts(UserScoreAggregate $score)
    {
        $scoreAggs = Score::where([
                'room_id' => $score->room_id,
                'user_id' => $score->user_id,
            ])->groupBy('playlist_item_id')
            ->selectRaw('COUNT(*) AS attempts, playlist_item_id')
            ->get();

        $attempts = [];

        foreach ($scoreAggs as $scoreAgg) {
            $attempts[] = [
                'attempts' => $scoreAgg->attempts,
                'id' => $scoreAgg->playlist_item_id,
            ];
        }

        return $this->primitive($attempts);
    }

    public function includePosition(UserScoreAggregate $score)
    {
        return $this->primitive($score->userRank());
    }

    public function includeUser(UserScoreAggregate $score)
    {
        return $this->item($score->user, new UserCompactTransformer());
    }
}
