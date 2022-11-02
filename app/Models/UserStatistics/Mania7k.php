<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\UserStatistics;

/**
 * @property int $a_rank_count
 * @property float $accuracy_new
 * @property string $country_acronym
 * @property \Carbon\Carbon $last_played
 * @property \Carbon\Carbon $last_update
 * @property int $playcount
 * @property float $rank_score
 * @property int $rank_score_index
 * @property int $s_rank_count
 * @property int $sh_rank_count
 * @property int $user_id
 * @property int $x_rank_count
 * @property int $xh_rank_count
 */
class Mania7k extends VariantModel
{
    protected $table = 'osu_user_stats_mania_7k';
}
