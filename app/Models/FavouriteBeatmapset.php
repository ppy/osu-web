<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property \Carbon\Carbon $dateadded
 * @property User $user
 * @property int $user_id
 */
class FavouriteBeatmapset extends Model
{
    protected $table = 'osu_favouritemaps';

    public $timestamps = false;
    protected $dates = [
        'dateadded',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }
}
