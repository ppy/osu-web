<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use Illuminate\Database\Eloquent\Model;

class RankHistory extends Model
{
    protected $table = 'osu_user_performance_rank';

    public $timestamps = false;

    protected $casts = [
        'user_id' => 'integer',
        'mode' => 'integer',
        // supposedly r0..r99 are also integer
        // but I'm not going to write them here <_<
    ];

    public function getDataAttribute()
    {
        $data = [];

        $startOffset = Count::currentRankStart();
        $end = $startOffset + 90;

        for ($i = $startOffset; $i < $end; $i++) {
            $column = 'r'.strval($i % 90);

            $data[] = intval($this->$column);
        }

        return $data;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
