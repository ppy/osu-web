<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Jobs\Notifications\UserAchievementUnlock;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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

    protected $casts = ['date' => 'datetime'];
    protected $primaryKey = ':composite';
    protected $primaryKeys = ['user_id', 'achievement_id'];
    protected $table = 'osu_user_achievements';

    /**
     * Unlock the medal for the given user.
     */
    public static function unlock(User $user, Achievement $achievement, ?Beatmap $beatmap = null): bool
    {
        return DB::transaction(function () use ($achievement, $beatmap, $user) {
            try {
                $userAchievement = $user->userAchievements()->create([
                    'achievement_id' => $achievement->getKey(),
                    'beatmap_id' => $beatmap?->getKey(),
                ]);
            } catch (Exception $e) {
                if (is_sql_unique_exception($e)) {
                    return false;
                }

                throw $e;
            }

            Event::generate('achievement', compact('achievement', 'user'));

            (new UserAchievementUnlock($achievement, $user))->dispatch();

            return true;
        });
    }

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
