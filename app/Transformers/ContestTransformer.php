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

namespace App\Transformers;

use App\Models\Contest;
use Auth;
use League\Fractal;

class ContestTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'entries',
    ];

    public function transform(Contest $contest)
    {
        $response = [
            'id' => $contest->id,
            'name' => $contest->name,
            'description' => $contest->description_voting,
            'type' => $contest->type,
            'header_url' => $contest->header_url,
            'max_entries' => $contest->max_entries,
            'max_votes' => $contest->max_votes,
            'entry_starts_at' => json_time($contest->entry_starts_at),
            'entry_ends_at' => json_time($contest->entry_ends_at),
            'voting_ends_at' => json_time($contest->voting_ends_at),
            'show_votes' => $contest->show_votes,
            'link_icon' => $contest->link_icon,
        ];

        if ($contest->type === 'art') {
            $response['shape'] = $contest->entry_shape;
        }

        if ($contest->isBestOf()) {
            $response['best_of'] = true;
        }

        return $response;
    }

    public function includeEntries(Contest $contest)
    {
        return $this->collection($contest->entriesByType(Auth::user()), new ContestEntryTransformer);
    }
}
