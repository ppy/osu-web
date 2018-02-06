<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use App\Models\UserStatistics;
use League\Fractal;

class UserStatisticsTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'rank',
        'scoreRanks',
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
            'hit_accuracy' => $stats->accuracy_new,
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

    public function includeScoreRanks(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        return $this->item($stats, function ($stats) {
            return [
                'XH' => $stats->xh_rank_count,
                'SH' => $stats->sh_rank_count,
                'X' => $stats->x_rank_count,
                'S' => $stats->s_rank_count,
                'A' => $stats->a_rank_count,
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
