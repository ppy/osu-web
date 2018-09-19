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

class BeatmapFailtimes extends Model
{
    protected $table = 'osu_beatmap_failtimes';

    public $timestamps = false;

    public function getDataAttribute()
    {
        $data = [];

        for ($i = 1; $i <= 100; $i++) {
            $column = 'p'.strval($i);

            $data[] = intval($this->$column);
        }

        return $data;
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function delete()
    {
        // only because laravel can't seem to support composite primary keys
        static::where('beatmap_id', $this->beatmap_id)
            ->where('type', $this->type)
            ->delete();
    }

    public static function find($beatmap_id, $type)
    {
        return static::where('beatmap_id', '=', $beatmap_id)
            ->where('type', '=', $type)
            ->first();
    }
}
