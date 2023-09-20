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
    const NO_MODS = 0;
    const MAX_COMBO = 9;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ':composite';
    protected $primaryKeys = ['beatmap_id', 'mode', 'mods', 'attrib_id'];
    protected $table = 'osu_beatmap_difficulty_attribs';

    public function scopeMode($query, $mode)
    {
        return $query->where('mode', $mode);
    }

    public function scopeMaxCombo($query)
    {
        return $query->where('attrib_id', static::MAX_COMBO);
    }

    public function scopeNoMods($query)
    {
        return $query->where('mods', static::NO_MODS);
    }
}
