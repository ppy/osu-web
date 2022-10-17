<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

/**
 * @property Achievement $achievement
 * @property int $achievement_id
 * @property \Carbon\Carbon $date
 * @property User $user
 * @property int $user_id
 */
class UserAchievement extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['date'];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'achievement_id'];
    protected $table = 'osu_user_achievements';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function achievement()
    {
        return $this->belongsTo(Achievement::class, 'achievement_id');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'achievement_id',
            'beatmap_id',
            'user_id' => $this->getRawAttribute($key),

            'date' => $this->getTimeFast($key),

            'date_json' => $this->getJsonTimeFast($key),

            'achievement',
            'user' => $this->getRelationValue($key),
        };
    }
}
