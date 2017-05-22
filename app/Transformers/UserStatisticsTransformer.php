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

use App\Models\Score\Best as ScoreBest;
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
            'total_score' => $stats->total_score,
            'total_hits' => $stats->totalHits(),
            'maximum_combo' => $stats->max_combo,
            'replays_watched_by_others' => $stats->replay_popularity,
            'grade_counts' => [
                'ss' => $stats->x_rank_count,
                's' => $stats->s_rank_count,
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
                'is_ranked' => $stats->rank_score_index > 0,
                'global' => $stats->rank_score_index,
                'country' => $stats->countryRank(),
            ];
        });
    }

    public function includeScoreRanks(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        if ($stats->user_id === null) {
            $scoreRankCounts = null;
        } else {
            $scoreRankClass = ScoreBest::class.'\\'.get_class_basename(get_class($stats));
            $scoreRankCounts = $scoreRankClass::where('user_id', '=', $stats->user_id)
                ->rankCounts()
                [$stats->user_id] ?? null;
        }

        return $this->item($scoreRankCounts, function ($scoreRankCounts) {
            return [
                'XH' => $scoreRankCounts['XH'] ?? 0,
                'SH' => $scoreRankCounts['SH'] ?? 0,
                'X' => $scoreRankCounts['X'] ?? 0,
                'S' => $scoreRankCounts['S'] ?? 0,
                'A' => $scoreRankCounts['A'] ?? 0,
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
