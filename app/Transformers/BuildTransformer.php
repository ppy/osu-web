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

use App\Models\Build;
use App\Models\ChangelogEntry;
use League\Fractal;

class BuildTransformer extends Fractal\TransformerAbstract
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
            ->filter(function ($item) use ($build) {
                return $item->stream_id === $build->stream_id;
            })->map(function ($item) {
                return ChangelogEntry::convertLegacy($item);
            });

        $entries = $build
            ->defaultChangelogEntries
            ->concat($legacyEntries)
            ->sortBy('created_at');

        if ($entries->count() === 0) {
            $entries = collect([ChangelogEntry::placeholder()]);
        }

        return $this->collection($entries, new ChangelogEntryTransformer);
    }

    public function includeUpdateStream(Build $build)
    {
        return $this->item($build->updateStream, new UpdateStreamTransformer);
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
