<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;

/**
 * @property int $playcount
 * @property int $user_id
 * @property string $year_month
 */
class UserMonthlyPlaycount extends Model
{
    protected $table = 'osu_user_month_playcount';
    public $timestamps = false;

    public function startDate()
    {
        $year = substr($this->year_month, 0, 2);
        $month = substr($this->year_month, 2, 2);

        return Carbon::parse("{$year}-{$month}-01");
    }
}
