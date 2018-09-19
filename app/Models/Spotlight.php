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
use DB;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class Spotlight extends Model
{
    public const PERIODIC_TYPES = ['bestof', 'monthly'];

    protected $table = 'osu_charts';
    protected $primaryKey = 'chart_id';
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'active' => 'boolean',
        'mode_specific' => 'boolean',
    ];

    protected $dates = ['chart_month', 'end_date', 'start_date'];

    public function beatmapsets(string $mode)
    {
        $tableName = DB::connection('mysql-charts')->getDatabaseName().'.'.$this->beatmapsetsTableName($mode);

        return Beatmapset::whereIn('beatmapset_id', function ($q) use ($tableName) {
            return $q->from($tableName)->select('beatmapset_id');
        });
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
        $clazz = ScoreBest\Model::getClass(Beatmap::MODES[$mode]);
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

    public function hasMode(string $mode)
    {
        return Schema::connection('mysql-charts')->hasTable($this->userStatsTableName($mode));
    }

    //=========================
    // Table helpers
    //=========================

    public function beatmapsetsTableName(string $mode)
    {
        if ($mode === 'osu' || !$this->mode_specific) {
            $name = "{$this->acronym}_beatmapsets";
        } else {
            $name = "{$this->acronym}_beatmapsets_{$mode}";
        }

        return $name;
    }

    public function bestScoresTableName(string $mode)
    {
        if ($mode === 'osu') {
            $name = "{$this->acronym}_scores_high";
        } else {
            $name = "{$this->acronym}_scores_{$mode}_high";
        }

        return $name;
    }

    public function userStatsTableName(string $mode)
    {
        if ($mode === 'osu') {
            $name = "{$this->acronym}_user_stats";
        } else {
            $name = "{$this->acronym}_user_stats_{$mode}";
        }

        return $name;
    }

    public function createTables()
    {
        DB::connection('mysql-charts')->transaction(function () {
            $modes = array_keys(Beatmap::MODES);
            if ($this->mode_specific) {
                foreach ($modes as $mode) {
                    static::createBeatmapsetTable($this->beatmapsetsTableName($mode));
                }
            } else {
                static::createBeatmapsetTable($this->beatmapsetsTableName('osu'));
            }

            foreach ($modes as $mode) {
                static::createBestScoresTable($this->bestScoresTableName($mode));
                static::createUserStatsTable($this->userStatsTableName($mode));
            }
        });
    }

    private static function createBeatmapsetTable(string $name)
    {
        \Log::debug("create table {$name}");

        Schema::connection('mysql-charts')->create($name, function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('beatmapset_id')->primary();
        });
    }

    private static function createBestScoresTable(string $name)
    {
        \Log::debug("create table {$name}");

        Schema::connection('mysql-charts')->create($name, function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('score_id');
            $table->unsignedMediumInteger('beatmap_id')->default(0);
            $table->unsignedMediumInteger('beatmapset_id')->default(0);
            $table->mediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->unsignedSmallInteger('maxcombo')->default(0);
            $table->enum('rank', ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH']);
            $table->unsignedSmallInteger('count50')->default(0);
            $table->unsignedSmallInteger('count100')->default(0);
            $table->unsignedSmallInteger('count300')->default(0);
            $table->unsignedSmallInteger('countmiss')->default(0);
            $table->unsignedSmallInteger('countgeki')->default(0);
            $table->unsignedSmallInteger('countkatu')->default(0);
            $table->boolean('perfect')->default(0);
            $table->unsignedMediumInteger('enabled_mods')->default(0);
            $table->timestamp('date')->useCurrent();
            $table->unique(['user_id', 'beatmap_id'], 'user_beatmap');
            $table->index(['beatmap_id', 'score'], 'beatmap_score');
            $table->index(['user_id', 'beatmapset_id'], 'user_beatmapset');
        });
    }

    private static function createUserStatsTable(string $name)
    {
        \Log::debug("create table {$name}");

        Schema::connection('mysql-charts')->create($name, function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->mediumInteger('user_id')->primary();
            $table->unsignedMediumInteger('count300')->default(0);
            $table->unsignedMediumInteger('count100')->default(0);
            $table->unsignedMediumInteger('count50')->default(0);
            $table->unsignedMediumInteger('countMiss')->default(0);
            $table->unsignedBigInteger('accuracy_total');
            $table->unsignedBigInteger('accuracy_count');
            $table->float('accuracy')->unsigned();
            $table->mediumInteger('playcount');
            $table->bigInteger('ranked_score');
            $table->bigInteger('total_score');
            $table->mediumInteger('x_rank_count');
            $table->mediumInteger('s_rank_count');
            $table->mediumInteger('a_rank_count');
            $table->mediumInteger('rank');
            $table->float('level')->unsigned();
            $table->unsignedMediumInteger('replay_popularity')->default(0);
            $table->unsignedMediumInteger('fail_count')->default(0);
            $table->unsignedMediumInteger('exit_count')->default(0);
            $table->unsignedSmallInteger('max_combo')->default(0);
            $table->index('total_score', 'total_score');
            $table->index('ranked_score', 'ranked_score');
            $table->index('playcount', 'playcount');
            $table->index('accuracy', 'accuracy');
            $table->index('rank', 'rank');
        });
    }
}
