<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\ReplayViewCount;

use App\Exceptions\ClassNotFoundException;
use App\Models\Beatmap;
use App\Models\Model as BaseModel;
use App\Models\Score\Best as ScoreBest;

abstract class Model extends BaseModel
{
    protected $primaryKey = 'score_id';

    public $timestamps = false;
    public $incrementing = false;

    public static function getClass(string $ruleset): string
    {
        if (!Beatmap::isModeValid($ruleset)) {
            throw new ClassNotFoundException();
        }

        return get_class_namespace(static::class).'\\'.studly_case($ruleset);
    }

    protected static function suffix()
    {
        return get_class_basename(static::class);
    }

    public function score()
    {
        $class = ScoreBest::class.'\\'.static::suffix();

        return $this->belongsTo($class, 'score_id');
    }
}
