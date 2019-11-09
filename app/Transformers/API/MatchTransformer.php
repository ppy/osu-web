<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\API;

use App\Models\Multiplayer\Match;
use League\Fractal;

class MatchTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = ['games'];

    public function transform(Match $match)
    {
        return [
            'match' => [
                'match_id' => $match->match_id,
                'name' => $match->name,
                'start_time' => $match->start_time ? $match->start_time->tz('Australia/Perth')->toDateTimeString() : null,
                'end_time' => $match->end_time ? $match->end_time->tz('Australia/Perth')->toDateTimeString() : null,
            ],
        ];
    }

    public function includeGames(Match $match)
    {
        return $this->collection(
            $match->games,
            new GameTransformer()
        );
    }
}
