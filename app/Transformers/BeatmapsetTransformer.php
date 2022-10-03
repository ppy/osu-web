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
        $threadId = $beatmapset->getAttr('thread_id') ?? 0;

        return array_merge(parent::transform($beatmapset), [
            'availability' => [
                'download_disabled' => (bool) $beatmapset->getAttr('download_disabled'),
                'more_information' => $beatmapset->getAttr('download_disabled_url'),
            ],
            'bpm' => $beatmapset->getAttr('bpm'),
            'can_be_hyped' => $beatmapset->canBeHyped(),
            'discussion_enabled' => true, // TODO: deprecated 2022-06-08
            'discussion_locked' => (bool) $beatmapset->getAttr('discussion_locked'),
            'is_scoreable' => $beatmapset->isScoreable(),
            'last_updated' => json_time_from_db_timestamp($beatmapset->getAttr('last_update')),
            'legacy_thread_url' => $threadId === 0 ? null : route('forum.topics.show', ['topic' => $threadId]),
            'nominations_summary' => $beatmapset->nominationsSummaryMeta(),
            'ranked' => $beatmapset->getAttr('approved'),
            'ranked_date' => json_time_from_db_timestamp($beatmapset->getAttr('approved_date')),
            'storyboard' => (bool) $beatmapset->getAttr('storyboard'),
            'submitted_date' => json_time_from_db_timestamp($beatmapset->getAttr('submit_date')),
            'tags' => $beatmapset->getAttr('tags'),
        ]);
    }
}
