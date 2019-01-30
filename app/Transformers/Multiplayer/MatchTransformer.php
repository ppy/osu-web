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

use App\Models\Multiplayer\Match;
use League\Fractal;

class MatchTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'events',
    ];

    public function transform(Match $match)
    {
        return [
            'id' => $match->match_id,
            'start_time' => json_time($match->start_time),
            'end_time' => json_time($match->end_time),
            'name' => $match->name,
        ];
    }

    public function includeEvents(Match $match)
    {
        return $this->collection(
            $match->events()->default()->get(),
            new EventTransformer
        );
    }
}
