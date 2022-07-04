<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

class BeatmapsetTransformer extends BeatmapsetCompactTransformer
{
    protected $beatmapTransformer = BeatmapTransformer::class;

    protected $defaultIncludes = [
        'availability',
        'bpm',
        'can_be_hyped',
        'discussion_enabled',
        'discussion_locked',
        'has_favourited',
        'is_scoreable',
        'last_updated',
        'legacy_thread_url',
        'nominations_summary',
        'ranked',
        'ranked_date',
        'storyboard',
        'submitted_date',
        'tags',
    ];

    protected $requiredPermission = 'BeatmapsetShow';
}
