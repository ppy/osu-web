<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
