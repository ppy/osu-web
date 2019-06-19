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

use App\Models\Multiplayer\RoomScore;
use App\Transformers\UserCompactTransformer;
use League\Fractal;

class RoomScoreTransformer extends Fractal\TransformerAbstract
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
