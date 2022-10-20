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
    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['last_update'];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['beatmap_id', 'mode', 'mods'];
    protected $table = 'osu_beatmap_difficulty';

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }
}
