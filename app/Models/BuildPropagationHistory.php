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

use Carbon\Carbon;
use DB;

class BuildPropagationHistory extends Model
{
    public $timestamps = false;
    protected $dates = [
        'created_at',
    ];

    public function build()
    {
        return $this->belongsTo(Build::class, 'build_id');
    }

    public function scopeChangelog($query, $streamId, $days)
    {
        $buildsTable = (new Build)->getTable();
        $propagationTable = (new self)->getTable();
        $streamsTable = config('database.connections.mysql-updates.database').'.'.(new UpdateStream)->getTable();

        $query->join($buildsTable, "{$buildsTable}.build_id", '=', "{$propagationTable}.build_id")
            ->select('created_at')
            ->where('created_at', '>', Carbon::now()->subDays($days))
            ->orderBy('created_at', 'asc');

        if ($streamId !== null) {
            $query->addSelect(DB::raw("user_count, {$buildsTable}.version as label"))
                ->where("{$buildsTable}.stream_id", $streamId);
        } else {
            $query->join($streamsTable, "{$streamsTable}.stream_id", '=', "{$buildsTable}.stream_id")
                // casting to integer here as the sum aggregate returns a string
                ->addSelect(DB::raw('cast(sum(user_count) as signed) as user_count, pretty_name as label'))
                ->whereIn("{$buildsTable}.stream_id", config('osu.changelog.update_streams'))
                ->groupBy(['created_at', 'pretty_name']);
        }
    }
}
