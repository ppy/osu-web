<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property int $attrib_id
 * @property int $beatmap_id
 * @property int $mode
 * @property int $mods
 * @property float|null $value
 */
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
