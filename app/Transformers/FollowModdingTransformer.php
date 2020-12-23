<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Follow;

class FollowModdingTransformer extends FollowTransformer
{
    protected $availableIncludes = [
        'latest_beatmapset',
        'user',
    ];

    private $latestBeatmapsets;

    public function __construct($latestBeatmapsets = null)
    {
        // should be keyed by "id"
        $this->latestBeatmapsets = $latestBeatmapsets;
    }

    public function includeUser(Follow $follow)
    {
        return $this->item($follow->notifiable, new UserCompactTransformer());
    }

    public function includeLatestBeatmapset(Follow $follow)
    {
        $comment = $this->latestBeatmapsets[$follow->notifiable_id] ?? null;

        if ($comment !== null) {
            return $this->item($comment, new BeatmapsetTransformer());
        }
    }
}
