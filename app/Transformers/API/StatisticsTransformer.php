<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\API;

use App\Models;
use App\Models\UserStatistics;
use League\Fractal;

class StatisticsTransformer extends Fractal\TransformerAbstract
{
    public function transform(Models\UserStatistics\Model $stats = null)
    {
        if ($stats === null) {
            $stats = new UserStatistics\Osu([], false);
        }

        return [
            'count300' => $stats->count300,
            'count100' => $stats->count100,
            'count50' => $stats->count50,
            'playcount' => $stats->playcount,
            'ranked_score' => $stats->ranked_score,
            'total_score' => $stats->total_score,
            'pp_rank' => $stats->rank_score_index,
            'level' => $stats->level,
            'pp_raw' => $stats->rank_score,
            'accuracy' => $stats->accuracy_new,
            'count_rank_ss' => $stats->x_rank_count,
            'count_rank_ssh' => $stats->xh_rank_count,
            'count_rank_s' => $stats->s_rank_count,
            'count_rank_sh' => $stats->sh_rank_count,
            'count_rank_a' => $stats->a_rank_count,
            'pp_country_rank' => $stats->countryRank(),
        ];
    }
}
