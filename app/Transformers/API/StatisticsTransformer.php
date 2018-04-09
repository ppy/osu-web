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
