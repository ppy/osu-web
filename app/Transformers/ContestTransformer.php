<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Contest;
use Auth;
use League\Fractal\Resource\ResourceInterface;

class ContestTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'entries',
        'users_voted_count',
    ];

    public function transform(Contest $contest)
    {
        return [
            'best_of' => $contest->isBestOf(),
            'description' => $contest->description_voting,
            'entry_ends_at' => json_time($contest->entry_ends_at),
            'entry_starts_at' => json_time($contest->entry_starts_at),
            'header_url' => $contest->header_url,
            'id' => $contest->id,
            'link_icon' => $contest->link_icon,
            'max_entries' => $contest->max_entries,
            'max_votes' => $contest->max_votes,
            'name' => $contest->name,
            'show_names' => $contest->show_names,
            'show_votes' => $contest->show_votes,
            'submitted_beatmaps' => $contest->isSubmittedBeatmaps(),
            'thumbnail_shape' => $contest->thumbnail_shape,
            'type' => $contest->type,
            'forced_width' => $contest->getForcedWidth(),
            'forced_height' => $contest->getForcedHeight(),
            'voting_ends_at' => json_time($contest->voting_ends_at),
        ];
    }

    public function includeEntries(Contest $contest)
    {
        return $this->collection($contest->entriesByType(Auth::user()), new ContestEntryTransformer());
    }

    public function includeUsersVotedCount(Contest $contest): ResourceInterface
    {
        return $this->primitive($contest->usersVotedCount());
    }
}
