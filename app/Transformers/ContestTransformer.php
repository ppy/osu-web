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
namespace App\Transformers;

use App\Models\Contest;
use League\Fractal;

class ContestTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'entries',
    ];

    public function transform(Contest $contest)
    {
        return [
            'id' => $contest->id,
            'name' => $contest->name,
            'description' => $contest->description_voting,
            'type' => $contest->type,
            'header_url' => $contest->header_url,
            'max_entries' => $contest->max_entries,
            'max_votes' => $contest->max_votes,
            'entry_ends_at' => $contest->entry_ends_at !== null ? $contest->entry_ends_at->toIso8601String() : null,
            'voting_ends_at' => $contest->voting_ends_at !== null ? $contest->voting_ends_at->toIso8601String() : null,
            'show_votes' => $contest->show_votes,
        ];
    }

    public function includeEntries(Contest $contest)
    {
        return $this->collection($contest->entries, new ContestEntryTransformer);
    }
}
