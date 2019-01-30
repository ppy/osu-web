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
