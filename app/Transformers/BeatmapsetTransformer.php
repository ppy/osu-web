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
        return array_merge(parent::transform($beatmapset), [
            'availability' => [
                'download_disabled' => $beatmapset->download_disabled,
                'more_information' => $beatmapset->download_disabled_url,
            ],
            'bpm' => $beatmapset->bpm,
            'can_be_hyped' => $beatmapset->canBeHyped(),
            'discussion_enabled' => true, // TODO: deprecated 2022-06-08
            'discussion_locked' => $beatmapset->discussion_locked,
            'is_scoreable' => $beatmapset->isScoreable(),
            'last_updated' => $beatmapset->last_update_json,
            'legacy_thread_url' => ($beatmapset->thread_id ?? 0) !== 0 ? route('forum.topics.show', ['topic' => $beatmapset->thread_id]) : null,
            'nominations_summary' => $beatmapset->nominationsSummaryMeta(),
            'ranked' => $beatmapset->approved,
            'ranked_date' => $beatmapset->approved_date_json,
            'storyboard' => $beatmapset->storyboard,
            'submitted_date' => $beatmapset->submit_date_json,
            'tags' => $beatmapset->tags,
        ]);
    }
}
