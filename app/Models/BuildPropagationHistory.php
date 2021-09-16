<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Carbon\Carbon;
use DB;

/**
 * @property Build $build
 * @property int $build_id
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property int $user_count
 */
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
        $buildsTable = (new Build())->getTable();
        $propagationTable = (new self())->getTable();
        $streamsTable = config('database.connections.mysql-updates.database').'.'.(new UpdateStream())->getTable();

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
