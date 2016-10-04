<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
        'user',
    ];

    public function transform(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        return [
            'rank' => [
                'score' => $stats->rank_score,
                'isRanked' => $stats->rank_score_index > 0,
                'global' => $stats->rank_score_index,
                'country' => $stats->countryRank(),
            ],

            'level' => [
                'current' => $stats->currentLevel(),
                'progress' => $stats->currentLevelProgressPercent(),
            ],

            'rankedScore' => $stats->ranked_score,
            'hitAccuracy' => $stats->accuracy_new,
            'playCount' => $stats->playcount,
            'totalScore' => $stats->total_score,
            'totalHits' => $stats->totalHits(),
            'maximumCombo' => $stats->max_combo,
            'replaysWatchedByOthers' => $stats->replay_popularity,

            'scoreRanks' => [
                'X' => $stats->x_rank_count,
                'S' => $stats->s_rank_count,
                'A' => $stats->a_rank_count,
            ],
        ];
    }

    public function includeUser($stats)
    {
        return $this->item($stats->user, new UserCompactTransformer);
    }
}
