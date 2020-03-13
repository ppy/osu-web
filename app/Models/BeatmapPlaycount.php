<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmap $beatmap
 * @property int $beatmap_id
 * @property int $playcount
 * @property User $user
 * @property int $user_id
 */
class BeatmapPlaycount extends Model
{
    protected $table = 'osu_user_beatmap_playcount';

    public $timestamps = false;

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
