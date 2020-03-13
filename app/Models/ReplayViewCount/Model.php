<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\ReplayViewCount;

use App\Models\Model as BaseModel;
use App\Models\Score\Best as ScoreBest;

abstract class Model extends BaseModel
{
    protected $primaryKey = 'score_id';

    public $timestamps = false;

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
