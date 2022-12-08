<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Achievement $achievement
 * @property int $achievement_id
 * @property-read Beatmap|null $beatmap
 * @property int|null $beatmap_id
 * @property \Carbon\Carbon $date
 * @property-read string $date_json
 * @property-read User $user
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

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class, 'achievement_id');
    }

    public function beatmap(): BelongsTo
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
            'beatmap',
            'user' => $this->getRelationValue($key),
        };
    }
}
