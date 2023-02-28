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
        $stats = UserStatistics\Model::getClass(Beatmap::modeStr($modeInt))
            ::where('country_acronym', $countryAcronym)
            ->whereHas('user', function ($userQuery) {
                return $userQuery->default();
            })->select(DB::raw('sum(ranked_score) AS ranked_score, sum(playcount) AS playcount, count(*) AS usercount, sum(rank_score) AS rank_score'))
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
