<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;

/**
 * @property int $count
 * @property int $user_id
 * @property string $year_month
 */
class UserReplaysWatchedCount extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'year_month'];
    protected $table = 'osu_user_replayswatched';

    public function startDate()
    {
        $year = substr($this->year_month, 0, 2);
        $month = substr($this->year_month, 2, 2);

        return Carbon::parse("{$year}-{$month}-01");
    }
}
