<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Beatmapset $beatmapset
 * @property int $beatmapset_id
 * @property \Carbon\Carbon|null $created_at
 * @property int $id
 * @property array $modes
 * @property bool $reset
 * @property \Carbon\Carbon|null $reset_at
 * @property User|null $reset_by
 * @property int|null $reset_user_id
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int $user_id
 */
class BeatmapsetNomination extends Model
{
    protected $casts = [
        'modes' => 'array',
    ];

    public function beatmapset()
    {
        return $this->belongsTo(Beatmapset::class, 'beatmapset_id');
    }

    public function scopeCurrent($query)
    {
        return $query->where('reset', false);
    }

    public function resetBy()
    {
        return $this->belongsTo(User::class, 'reset_user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
