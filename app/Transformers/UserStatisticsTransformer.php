<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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
    public function transform(UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu();
        }

        return [
            'rank' => [
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
                'ss' => $stats->x_rank_count,
                's' => $stats->s_rank_count,
                'a' => $stats->a_rank_count,
            ],
        ];
    }
}
