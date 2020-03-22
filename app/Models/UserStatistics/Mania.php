<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\UserStatistics;

/**
 * @property int $a_rank_count
 * @property float $accuracy
 * @property int $accuracy_count
 * @property float $accuracy_new
 * @property int $accuracy_total
 * @property int $count100
 * @property int $count300
 * @property int $count50
 * @property int $countMiss
 * @property string $country_acronym
 * @property int $exit_count
 * @property int $fail_count
 * @property float $hit_accuracy
 * @property \Carbon\Carbon $last_played
 * @property \Carbon\Carbon $last_update
 * @property float $level
 * @property int $max_combo
 * @property int $playcount
 * @property int $rank
 * @property float $rank_score
 * @property int $rank_score_index
 * @property int $ranked_score
 * @property int $replay_popularity
 * @property int $s_rank_count
 * @property int $sh_rank_count
 * @property int $total_score
 * @property int $user_id
 * @property int $x_rank_count
 * @property int $xh_rank_count
 */
class Mania extends Model
{
    protected $table = 'osu_user_stats_mania';
}
