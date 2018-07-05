<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Models;

use App\Models\Score\Best as ScoreBest;
use App\Models\UserStatistics;
use DB;

class Spotlight extends Model
{
    protected $table = 'osu_charts';
    protected $primaryKey = 'chart_id';
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'active' => 'boolean',
        'mode_specific' => 'boolean',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function beatmapsets(string $mode)
    {
        $beatmapsetIds = DB::connection('mysql-charts')
            ->table($this->beatmapsetsTableName($mode))
            ->pluck('beatmapset_id');

        return Beatmapset::whereIn('beatmapset_id', $beatmapsetIds);
    }

    /**
     * Returns a builder for best scores.
     * IMPORTANT: The models returned by the query will have the incorrect table set.
     *
     * @param string $mode
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scores(string $mode)
    {
        $clazz = '\App\Models\Score\Best\\'.studly_case($mode);
        $model = new $clazz;
        $model->setTable($this->bestScoresTableName($mode));
        $model->setConnection('mysql-charts');

        return $model->newQuery();
    }

    /**
     * Returns a builder for user_stats.
     * IMPORTANT: The models returned by the query will have the incorrect table set.
     *
     * @param string $mode
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function userStats(string $mode)
    {
        $clazz = UserStatistics\Model::getClass($mode);
        $model = new $clazz;
        $model->setTable($this->userStatsTableName($mode));
        $model->setConnection('mysql-charts');

        return $model->newQuery();
    }

    public function beatmapsetsTableName(string $mode)
    {
        if ($mode === 'osu' || !$this->mode_specific) {
            return "{$this->acronym}_beatmapsets";
        } else {
            return "{$this->acronym}_beatmapsets_{$mode}";
        }
    }

    public function bestScoresTableName(string $mode)
    {
        if ($mode === 'osu') {
            return "{$this->acronym}_scores_high";
        } else {
            return "{$this->acronym}_scores_{$mode}_high";
        }
    }

    public function userStatsTableName(string $mode)
    {
        if ($mode === 'osu') {
            return "{$this->acronym}_user_stats";
        } else {
            return "{$this->acronym}_user_stats_{$mode}";
        }
    }
}
