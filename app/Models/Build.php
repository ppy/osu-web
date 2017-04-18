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

class Build extends Model
{
    public $timestamps = false;

    protected $table = 'osu_builds';
    protected $primaryKey = 'build_id';

    public function updateStream()
    {
        return $this->belongsTo(UpdateStream::class, 'stream_id', 'stream_id');
    }

    public function changelogs()
    {
        return $this->hasMany(Changelog::class, 'build', 'version');
    }

    public function scopeLatestByStream($query)
    {
        $query
            ->whereNotNull('stream_id')
            ->whereNotExists(function ($q) {
                $table = $this->getTable();
                $q->selectRaw(1)
                    ->from(DB::raw("{$table} b2"))
                    ->whereRaw("b2.stream_id = {$table}.stream_id")
                    ->whereRaw("b2.date > {$table}.date");
            });
    }
}
