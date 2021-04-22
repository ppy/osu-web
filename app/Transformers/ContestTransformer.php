<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Contest;
use Auth;

class ContestTransformer extends TransformerAbstract
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

        if ($contest->hasThumbnails()) {
            $response['thumbnail_shape'] = $contest->thumbnail_shape;
        }

        if ($contest->isBestOf()) {
            $response['best_of'] = true;
        }

        return $response;
    }

    public function includeEntries(Contest $contest)
    {
        return $this->collection($contest->entriesByType(Auth::user()), new ContestEntryTransformer());
    }
}
