<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score;

use App\Exceptions\ClassNotFoundException;
use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\User;
use App\Traits\Scoreable;

/**
 * @property Beatmap $beatmap
 * @property User $user
 */
abstract class Model extends BaseModel
{
    use Scoreable;

    protected $primaryKey = 'score_id';

    protected $casts = [
        'perfect' => 'boolean',
        'replay' => 'boolean',
    ];
    protected $dates = ['date'];

    protected $guarded = [];

    public $timestamps = false;

    public static function getClass($modeInt)
    {
        $modeStr = Beatmap::modeStr($modeInt);

        if ($modeStr !== null) {
            return static::getClassByString($modeStr);
        }
    }

    public static function getClassByString(string $mode)
    {
        if (!Beatmap::isModeValid($mode)) {
            throw new ClassNotFoundException();
        }

        return get_class_namespace(static::class).'\\'.studly_case($mode);
    }

    public static function getMode(): string
    {
        return snake_case(get_class_basename(static::class));
    }

    public function scopeDefault($query)
    {
        return $query
            ->where('rank', '<>', 'F')
            ->whereHas('beatmap')
            ->orderBy('score_id', 'desc');
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function scopeVisibleUsers($query)
    {
        return $query->whereHas('user', function ($userQuery) {
            $userQuery->default();
        });
    }

    public function beatmap()
    {
        return $this->belongsTo(Beatmap::class, 'beatmap_id');
    }

    public function best()
    {
        $basename = get_class_basename(static::class);

        return $this->belongsTo("App\\Models\\Score\\Best\\{$basename}", 'high_score_id', 'score_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getBestIdAttribute()
    {
        return $this->high_score_id;
    }
}
