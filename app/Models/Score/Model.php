<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score;

use App\Exceptions\ClassNotFoundException;
use App\Libraries\ModsHelper;
use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\Traits\Scoreable;
use App\Models\User;

/**
 * @property Beatmap $beatmap
 * @property User $user
 */
abstract class Model extends BaseModel
{
    use Scoreable;

    public $timestamps = false;

    protected $primaryKey = 'score_id';

    protected $casts = [
        'pass' => 'bool',
        'perfect' => 'bool',
        'replay' => 'bool',
    ];
    protected $dates = ['date'];

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

    public function difficultyRating(): ?float
    {
        $value = $this->beatmap
            ->difficulty()
            ->where('mode', Beatmap::modeInt(static::getMode()))
            ->where('mods', ModsHelper::toBitset($this->enabled_mods))
            ->first()
            ?->diff_unified;

        return $value === null ? null : round($value, 2);
    }

    public function scopeDefault($query)
    {
        return $query
            ->whereHas('beatmap')
            ->orderBy('score_id', 'desc');
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function scopeIncludeFails($query, bool $include)
    {
        if ($include) {
            return $query;
        }

        return $query->where('pass', true);
    }

    public function scopeVisibleUsers($query)
    {
        return $query->whereHas('user', function ($userQuery) {
            $userQuery->default();
        });
    }

    public function scopeWithMods($query, $modsArray)
    {
        return $query->where(function ($q) use ($modsArray) {
            $bitset = ModsHelper::toBitset($modsArray);
            $preferenceMask = ~ModsHelper::PREFERENCE_MODS_BITSET;

            if (in_array('NM', $modsArray, true)) {
                $q->orWhereRaw('enabled_mods & ? = 0', [$preferenceMask]);
            }

            if ($bitset > 0) {
                $q->orWhereRaw('enabled_mods & ? = ?', [$preferenceMask | $bitset, $bitset]);
            }
        });
    }

    public function scopeWithoutMods($query, $modsArray)
    {
        $bitset = ModsHelper::toBitset($modsArray);

        return $query->whereRaw('enabled_mods & ? = 0', $bitset);
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

    public function url()
    {
        return route('scores.show', ['mode' => static::getMode(), 'score' => $this->getKey()]);
    }
}
