<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Build;
use App\Models\ChangelogEntry;

class BuildTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'changelog_entries',
        'update_stream',
        'versions',
    ];

    protected $defaultIncludes = [
        'update_stream',
    ];

    public function transform(Build $build)
    {
        return [
            'id' => $build->getKey(),
            'version' => $build->version,
            'display_version' => $build->displayVersion(),
            'users' => $build->users ?? 0,
            'created_at' => json_time($build->date),
        ];
    }

    public function includeChangelogEntries(Build $build)
    {
        $legacyEntries = $build
            ->defaultChangelogs
            ->filter(fn ($item) => $item->stream_id === $build->stream_id)
            ->map(fn ($item) => ChangelogEntry::convertLegacy($item));

        $entries = $build
            ->defaultChangelogEntries
            ->concat($legacyEntries)
            ->sortBy('created_at');

        if ($entries->count() === 0) {
            $entries = collect([ChangelogEntry::placeholder()]);
        }

        return $this->collection($entries, new ChangelogEntryTransformer());
    }

    public function includeUpdateStream(Build $build)
    {
        return $this->item($build->updateStream, new UpdateStreamTransformer());
    }

    public function includeVersions(Build $build)
    {
        return $this->item($build, function ($build) {
            $versions = [];

            if ($build->versionNext() !== null) {
                $versions['next'] = json_item($build->versionNext(), 'Build');
            }

            if ($build->versionPrevious() !== null) {
                $versions['previous'] = json_item($build->versionPrevious(), 'Build');
            }

            return $versions;
        });
    }
}
