<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
