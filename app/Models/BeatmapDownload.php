<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property int $fulfilled
 * @property BeatmapMirror $mirror
 * @property int $mirror_id
 * @property int $timestamp
 * @property User $user
 * @property int $user_id
 */
class BeatmapDownload extends Model
{
    protected $table = 'osu_downloads';
    protected $primaryKey = 'user_id';

    public $timestamps = false;

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function mirror()
    {
        return $this->belongsTo(BeatmapMirror::class, 'mirror_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
