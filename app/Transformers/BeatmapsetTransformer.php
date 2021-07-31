<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Beatmapset;

class BeatmapsetTransformer extends BeatmapsetCompactTransformer
{
    protected $beatmapTransformer = BeatmapTransformer::class;

    protected $defaultIncludes = [
        'has_favourited',
    ];

    protected $requiredPermission = 'BeatmapsetShow';

    public function transform(Beatmapset $beatmapset)
    {
        $result = parent::transform($beatmapset);

        return array_merge($result, [
            'availability' => [
                'download_disabled' => $beatmapset->download_disabled,
                'more_information' => $beatmapset->download_disabled_url,
            ],
            'bpm' => $beatmapset->bpm,
            'can_be_hyped' => $beatmapset->canBeHyped(),
            'creator' => $beatmapset->creator,
            'discussion_enabled' => $beatmapset->discussion_enabled,
            'discussion_locked' => $beatmapset->discussion_locked,
            'is_scoreable' => $beatmapset->isScoreable(),
            'last_updated' => json_time($beatmapset->last_update),
            'legacy_thread_url' => $beatmapset->thread_id !== 0 ? route('forum.topics.show', $beatmapset->thread_id) : null,
            'nominations_summary' => $beatmapset->nominationsSummaryMeta(),
            'ranked' => $beatmapset->approved,
            'ranked_date' => json_time($beatmapset->approved_date),
            'storyboard' => $beatmapset->storyboard,
            'submitted_date' => json_time($beatmapset->submit_date),
            'tags' => $beatmapset->tags,
        ]);
    }
}
