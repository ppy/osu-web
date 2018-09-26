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

namespace App\Models;

use DB;

class CountryStatistics extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'acronym');
    }

    public static function recalculate($countryAcronym, $modeInt)
    {
        $stats = UserStatistics\Model::getClass(Beatmap::modeStr($modeInt))
            ::where('country_acronym', $countryAcronym)
            ->select(DB::raw('sum(ranked_score) AS ranked_score, sum(playcount) AS playcount, count(*) AS usercount, sum(rank_score) AS rank_score'))
            ->first();

        if ($stats->ranked_score > 0) {
            self::updateOrCreate([
                'country_code' => $countryAcronym,
                'mode' => $modeInt,
            ], [
                'ranked_score' => $stats->ranked_score,
                'play_count' => $stats->playcount,
                'user_count' => $stats->usercount,
                'performance' => $stats->rank_score,
            ]);
        }
    }
}
