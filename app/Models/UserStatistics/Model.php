<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Models\UserStatistics;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    protected $primaryKey = 'user_id';

    protected $casts = [
        'accuracy_new' => 'float',
        'count100' => 'integer',
        'count300' => 'integer',
        'count50' => 'integer',
        'countMiss' => 'integer',
        'level' => 'float',
        'max_combo' => 'integer',
        'playcount' => 'integer',
        'rank_score' => 'float',
        'rank_score_index' => 'integer',
        'ranked_score' => 'integer',
        'replay_popularity' => 'integer',
        'total_score' => 'integer',
        'user_id' => 'integer',

        'x_rank_count' => 'integer',
        's_rank_count' => 'integer',
        'a_rank_count' => 'integer',
    ];

    protected $guarded = [];

    const UPDATED_AT = 'last_update';

    public function setCreatedAt($value)
    {
        // Do nothing.
    }

    public function getCreatedAtColumn()
    {
        // Do nothing.
    }

    public function getCountryAcronymAttribute($value)
    {
        return presence($value);
    }

    public function currentLevelProgress()
    {
        return fmod($this->level, 1);
    }

    public function currentLevelProgressPercent()
    {
        return floor($this->currentLevelProgress() * 100);
    }

    public function currentLevel()
    {
        return intval($this->level);
    }

    public function totalHits()
    {
        return $this->count300 + $this->count100 + $this->count50;
    }

    public function countryRank()
    {
        if ($this->country_acronym === null) {
            return;
        }

        // Using $this->rank_score isn't accurate because it's a float value.
        // Hence the raw sql query.
        // There's this alternative
        //   rank_score_index < $this->rank_score_index AND rank_score_index > 0 AND rank_score > 0
        // but it is slower.
        return static::where('country_acronym', $this->country_acronym)
            ->where('rank_score', '>', function ($q) {
                $q->from($this->table)->where('user_id', $this->user_id)->select('rank_score');
            })
            ->count() + 1;
    }

    public function __construct($attributes = [], $zeroInsteadOfNull = true)
    {
        if ($zeroInsteadOfNull) {
            $this->level = 1;

            $this->rank_score_index = 0;
            $this->ranked_score = 0;

            $this->accuracy_new = 0;
            $this->playcount = 0;
            $this->total_score = 0;
            $this->max_combo = 0;

            $this->count300 = 0;
            $this->count100 = 0;
            $this->count50 = 0;

            $this->replay_popularity = 0;

            $this->x_rank_count = 0;
            $this->s_rank_count = 0;
            $this->a_rank_count = 0;
        }

        return parent::__construct($attributes);
    }
}
