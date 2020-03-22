<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\Multiplayer;

use App\Models\Multiplayer\RoomScore;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class RoomScoreTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user',
    ];

    public function transform(RoomScore $score)
    {
        return [
            'id' => $score->id,
            'user_id' => $score->user_id,
            'room_id' => $score->room_id,
            'playlist_item_id' => $score->playlist_item_id,
            'beatmap_id' => $score->beatmap_id,
            'rank' => $score->rank,
            'total_score' => $score->total_score,
            'accuracy' => $score->accuracy,
            'max_combo' => $score->max_combo,
            'mods' => $score->mods,
            'statistics' => $score->statistics,
            'passed' => $score->passed,

            'started_at' => json_time($score->started_at),
            'ended_at' => json_time($score->ended_at),
        ];
    }

    public function includeUser(RoomScore $score)
    {
        return $this->item(
            $score->user,
            new UserCompactTransformer
        );
    }
}
