<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
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

class Beatmap extends Model
{
    protected $table = 'osu_beatmaps';
    protected $primaryKey = 'beatmap_id';

    protected $casts = [
        "beatmap_id" => "integer",
        "beatmapset_id" => "integer",
        "user_id" => "integer",
        "total_length" => "integer",
        "hit_length" => "integer",
        "countTotal" => "integer",
        "countNormal" => "integer",
        "countSlider" => "integer",
        "countSpinner" => "integer",
        "diff_drain" => "float",
        "diff_size" => "float",
        "diff_overall" => "float",
        "diff_approach" => "float",
        "playmode" => "integer",
        "approved" => "integer",
        "difficultyrating" => "float",
        "playcount" => "integer",
        "passcount" => "integer",
        "orphaned" => "boolean",
    ];

    protected $dates = ["last_update"];
    public $timestamps = false;

    protected $hidden = ['checksum', 'filename', 'orphaned'];

    // playmodes
    const OSU = 0;
    const TAIKO = 1;
    const CTB = 2;
    const MANIA = 3;

    // TODO: scopes

    public function mods()
    {
        return $this->hasMany('Mod', 'beatmap_id', 'beatmap_id');
    }

    public function parent()
    {
        return $this->hasOne('Set', 'beatmapset_id', 'beatmapset_id');
    }

    public function creator()
    {
        return $this->hasOneThrough('User', 'Set');
    }
}
