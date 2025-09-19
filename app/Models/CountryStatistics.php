<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use DB;

/**
 * @property Country $country
 * @property string $country_code
 * @property \Carbon\Carbon|null $created_at
 * @property int $display
 * @property int $id
 * @property int $mode
 * @property int $performance
 * @property int $play_count
 * @property int $ranked_score
 * @property \Carbon\Carbon|null $updated_at
 * @property int $user_count
 */
class CountryStatistics extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'acronym');
    }

    public static function recalculate($countryAcronym, $modeInt)
    {
        $statisticsQuery = UserStatistics\Model::getClass(Beatmap::modeStr($modeInt))
            ::where('country_acronym', $countryAcronym)
            ->where('rank_score', '>', 0)
            ->whereHas('user', fn ($userQuery) => $userQuery->default());

        $stats = $statisticsQuery
            ->select(DB::raw('sum(ranked_score) AS ranked_score, sum(playcount) AS playcount, count(*) AS usercount'))
            ->first();

        $conds = [
            'country_code' => $countryAcronym,
            'mode' => $modeInt,
        ];

        if ($stats->ranked_score > 0) {
            $userPerformances = $statisticsQuery->clone()
                ->select('rank_score')
                ->orderBy('rank_score', 'desc')
                ->limit($GLOBALS['cfg']['osu']['rankings']['country_performance_user_count'])
                ->get();

            $totalPerformance = 0;
            $factor = 1.0;

            foreach ($userPerformances as $userPerformance) {
                $totalPerformance += $userPerformance->rank_score * $factor;
                $factor *= $GLOBALS['cfg']['osu']['rankings']['country_performance_weighting_factor'];
            }

            self::updateOrCreate($conds, [
                'ranked_score' => $stats->ranked_score,
                'play_count' => $stats->playcount,
                'user_count' => $stats->usercount,
                'performance' => $totalPerformance,
            ]);
        } else {
            self::where($conds)->delete();
        }
    }
}
