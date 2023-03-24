<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ContestEntry;
use App\Models\DeletedUser;
use Sentry\State\Scope;

class ContestEntryTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'artMeta',
        'results',
        'user',
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
        return $this->primitive([
            'actual_name' => $entry->name,
            'votes' => (int) $entry->votes_count,
        ]);
    }

    public function includeUser(ContestEntry $entry)
    {
        return $this->primitive([
            'id' => $entry->user_id,
            'username' => ($entry->user ?? (new DeletedUser()))->username,
        ]);
    }

    public function includeArtMeta(ContestEntry $entry)
    {
        if (!$entry->contest->hasThumbnails() || !presence($entry->entry_url)) {
            return $this->primitive([]);
        }

        $thumbnailUrl = $entry->thumbnail();
        // suffix urls when contests are made live to ensure image dimensions are forcibly rechecked
        if ($entry->contest->visible) {
            $urlSuffix = str_contains($thumbnailUrl, '?') ? '&live' : '?live';
        }

        $size = fast_imagesize($thumbnailUrl.($urlSuffix ?? ''));

        if ($size === null) {
            app('sentry')->getClient()->captureMessage(
                'Failed fetching image size of contest entry',
                null,
                (new Scope())
                    ->setExtra('id', $entry->getKey())
                    ->setExtra('url', $thumbnailUrl),
            );
        }

        return $this->primitive([
            'width' => $size[0] ?? 0,
            'height' => $size[1] ?? 0,
        ]);
    }
}
