<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserContestEntry;

class UserContestEntryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user',
    ];

    public function transform(UserContestEntry $entry)
    {
        return [
            'id' => $entry->id,
            'filename' => $entry->original_filename,
            'filesize' => $entry->filesize,
            'url' => $entry->fileUrl(),
            'thumb' => mini_asset($entry->fileUrl()),
            'created_at' => json_time($entry->created_at),
            'deleted' => $entry->deleted_at !== null,
        ];
    }

    public function includeUser(UserContestEntry $entry)
    {
        return $this->item(
            $entry->user ?? (new DeletedUser()),
            new UserCompactTransformer()
        );
    }
}
