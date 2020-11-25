<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Score;

use App\Exceptions\ClassNotFoundException;
use App\Libraries\ModsHelper;
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
            ->whereHas('beatmap')
            ->orderBy('score_id', 'desc');
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function scopeIncludeFails($query, bool $include = false)
    {
        if ($include) {
            return $query;
        }

        // FIXME: on mysql 8.0.22, character set (coercibility?) difference causes query error.
        //
        // The error itself doesn't manifest if only doing `Score\Osu::where('rank', '<>', 'F')`.
        // It's when having more conditions like `Score\Osu::where('user_id', 1)->where('rank', '<>', 'F')`
        // then mysql spits out error.
        //
        // One alternative is using CONVERT: `whereRaw('`rank` <> CONVERT(? USING latin1)', ['F'])`.
        // The character set for CONVERT() doesn't actually matter - doing this at all allows
        // mysql to coerce the value to the column's character set. Presumably. The writer of this
        // comment isn't sure either why this works.
        //
        // Skipping variable binding altogether and using literal query also works (used here).
        //
        // Also note the error only happens when using prepared statement with binding value.
        //
        // Original error:
        // General error: 1267 Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8mb4_0900_ai_ci,COERCIBLE) for operation '<>'
        //
        // Maybe references:
        // - https://dev.mysql.com/doc/relnotes/mysql/8.0/en/news-8-0-22.html#mysqld-8-0-22-optimizer
        // - https://dev.mysql.com/doc/refman/8.0/en/type-conversion.html
        return $query->whereRaw("`rank` <> 'F'");
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

    public function getBestIdAttribute()
    {
        return $this->high_score_id;
    }

    public function url()
    {
        return route('scores.show', ['mode' => static::getMode(), 'score' => $this->getKey()]);
    }
}
