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

        $attrs = $beatmapset->getAttributes();

        return array_merge($result, [
            'availability' => [
                'download_disabled' => (bool) ($attrs['download_disabled'] ?? null),
                'more_information' => $attrs['download_disabled_url'] ?? null,
            ],
            'bpm' => $attrs['bpm'] ?? null,
            'can_be_hyped' => $beatmapset->canBeHyped(),
            'discussion_enabled' => true, // TODO: deprecated 2022-06-08
            'discussion_locked' => (bool) ($attrs['discussion_locked'] ?? false),
            'is_scoreable' => $beatmapset->isScoreable(),
            'last_updated' => json_time_from_db_timestamp($attrs['last_update'] ?? null),
            'legacy_thread_url' => ($attrs['thread_id'] ?? 0) !== 0 ? route('forum.topics.show', $attrs['thread_id']) : null,
            'nominations_summary' => $beatmapset->nominationsSummaryMeta(),
            'ranked' => $attrs['approved'] ?? null,
            'ranked_date' => json_time_from_db_timestamp($attrs['approved_date'] ?? null),
            'storyboard' => (bool) ($attrs['storyboard'] ?? false),
            'submitted_date' => json_time_from_db_timestamp($attrs['submit_date'] ?? null),
            'tags' => $attrs['tags'] ?? null,
        ]);
    }
}
