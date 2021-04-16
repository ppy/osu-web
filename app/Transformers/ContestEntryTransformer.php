<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ContestEntry;

class ContestEntryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'results',
        'artMeta',
    ];

    public function transform(ContestEntry $entry)
    {
        return [
            'id' => $entry->id,
            'title' => $entry->contest->unmasked ? $entry->name : $entry->masked_name,
            'preview' => $entry->entry_url,
        ];
    }

    public function includeResults(ContestEntry $entry)
    {
        return $this->item($entry, function ($entry) {
            return [
                'actual_name' => $entry->name,
                'user_id' => $entry->user_id,
                'username' => ($entry->user ?? (new \App\Models\DeletedUser()))->username,
                'votes' => (int) $entry->votes_count,
            ];
        });
    }

    public function includeArtMeta(ContestEntry $entry)
    {
        if (!$entry->contest->hasEntryImages() || !presence($entry->entry_url)) {
            return $this->item($entry, function ($entry) {
                return [];
            });
        }

        return $this->item($entry, function ($entry) {
            $previewUrl = presence($entry->preview_url) ?? $entry->entry_url;

            // suffix urls when contests are made live to ensure image dimensions are forcibly rechecked
            if ($entry->contest->visible) {
                $urlSuffix = str_contains($previewUrl, '?') ? '&live' : '?live';
            }

            $size = fast_imagesize($previewUrl.($urlSuffix ?? ''));
            $thumb = mini_asset($previewUrl);

            return [
                'width' => $size[0],
                'height' => $size[1],
                'thumb' => $thumb,
            ];
        });
    }
}
