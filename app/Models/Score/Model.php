<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Score;

use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\User;
use App\Traits\Scoreable;

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

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->user_id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public static function getClass($modeInt)
    {
        $modeStr = Beatmap::modeStr($modeInt);

        if ($modeStr !== null) {
            return static::getClassByString($modeStr);
        }
    }

    public static function getClassByString(string $mode)
    {
        return get_class_namespace(static::class).'\\'.studly_case($mode);
    }

    public static function getMode() : string
    {
        return snake_case(get_class_basename(static::class));
    }

    public function scopeDefault($query)
    {
        return $query
            ->where('rank', '<>', 'F')
            ->whereHas('beatmap')
            ->whereHas('user', function ($userQuery) {
                $userQuery->default();
            })
            ->orderBy('score_id', 'desc');
    }
}
