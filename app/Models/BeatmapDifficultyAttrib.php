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

class BeatmapDifficultyAttrib extends Model
{
    protected $table = 'osu_beatmap_difficulty_attribs';
    protected $primaryKey = null;

    public $timestamps = false;

    public function scopeMode($query, $mode)
    {
        return $query->where('mode', $mode);
    }

    public function scopeMaxCombo($query)
    {
        return $query->where('attrib_id', 9);
    }

    public function scopeNoMods($query)
    {
        return $query->where('mods', 0);
    }
}
