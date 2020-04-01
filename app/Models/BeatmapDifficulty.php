<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmap $beatmap
 * @property int $beatmap_id
 * @property float $diff_unified
 * @property \Carbon\Carbon $last_update
 * @property int $mode
 * @property int $mods
 */
class BeatmapDifficulty extends Model
{
    protected $table = 'osu_beatmap_difficulty';
    protected $primaryKey = null;

    public $dates = ['last_updated'];
    public $incrementing = false;
    public $timestamps = false;

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }
}
