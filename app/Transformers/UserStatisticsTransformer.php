<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\UserStatistics;

class UserStatisticsTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'rank',
        'user',
    ];

    public function transform(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        return [
            'level' => [
                'current' => $stats->currentLevel(),
                'progress' => $stats->currentLevelProgressPercent(),
            ],

            'pp' => $stats->rank_score,
            'pp_rank' => $stats->rank_score_index,
            'ranked_score' => $stats->ranked_score,
            'hit_accuracy' => $stats->hit_accuracy,
            'play_count' => $stats->playcount,
            'play_time' => $stats->total_seconds_played,
            'total_score' => $stats->total_score,
            'total_hits' => $stats->totalHits(),
            'maximum_combo' => $stats->max_combo,
            'replays_watched_by_others' => $stats->replay_popularity,
            'is_ranked' => $stats->isRanked(),
            'grade_counts' => [
                'ss' => $stats->x_rank_count,
                'ssh' => $stats->xh_rank_count,
                's' => $stats->s_rank_count,
                'sh' => $stats->sh_rank_count,
                'a' => $stats->a_rank_count,
            ],
        ];
    }

    public function includeRank(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        return $this->item($stats, function ($stats) {
            return [
                'global' => $stats->globalRank(),
                'country' => $stats->countryRank(),
            ];
        });
    }

    public function includeUser(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        return $this->item($stats->user, new UserCompactTransformer);
    }
}
