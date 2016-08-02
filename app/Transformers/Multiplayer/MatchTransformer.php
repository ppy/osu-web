<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
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

use League\Fractal;
use App\Models\Multiplayer\Match;

class MatchTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'events',
        'users'
    ];

    public function transform(Match $match)
    {
        return [
            'id' => $match->match_id,
            'start_time' => $match->start_time->toIso8601String(),
            'end_time' => $match->end_time ? $match->end_time->toIso8601String() : null,
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
