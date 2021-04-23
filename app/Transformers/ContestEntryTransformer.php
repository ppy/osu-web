<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ContestEntry;
use App\Models\DeletedUser;

class ContestEntryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'results',
        'artMeta',
    ];

    public function transform(ContestEntry $entry)
    {
        $return = [
            'id' => $entry->id,
            'title' => $entry->contest->unmasked ? $entry->name : $entry->masked_name,
            'preview' => $entry->entry_url,
        ];

        if ($entry->contest->hasThumbnails()) {
            $return['thumbnail'] = mini_asset($entry->thumbnail());
        }

        return $return;
    }

    public function includeResults(ContestEntry $entry)
    {
        return $this->item($entry, function ($entry) {
            return [
                'actual_name' => $entry->name,
                'user_id' => $entry->user_id,
                'username' => ($entry->user ?? (new DeletedUser()))->username,
                'votes' => (int) $entry->votes_count,
            ];
        });
    }

    public function includeArtMeta(ContestEntry $entry)
    {
        if (!$entry->contest->hasThumbnails() || !presence($entry->entry_url)) {
            return $this->item($entry, function ($entry) {
                return [];
            });
        }

        return $this->item($entry, function ($entry) {
            // suffix urls when contests are made live to ensure image dimensions are forcibly rechecked
            if ($entry->contest->visible) {
                $urlSuffix = str_contains($entry->thumbnail(), '?') ? '&live' : '?live';
            }

            $size = fast_imagesize($entry->thumbnail().($urlSuffix ?? ''));

            return [
                'width' => $size[0],
                'height' => $size[1],
            ];
        });
    }
}
