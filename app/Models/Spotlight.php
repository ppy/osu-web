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

use App\Models\Beatmap;
use App\Models\Score\Best as ScoreBest;
use App\Models\UserStatistics;
use Carbon\Carbon;
use DB;
use Schema;
use Illuminate\Database\Schema\Blueprint;

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

    public function scopeMonthly($query)
    {
        return $query->where('type', 'monthly');
    }

    public function scopeNotMonthly($query)
    {
        return $query->where('type', '!=', 'monthly');
    }

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

    /**
     * Gets the period the monthly spotlight is for.
     * This is not the same as the spotlight's running duration.
     *
     * @return Carbon\Carbon
     */
    public function getPeriod()
    {
        // or maybe parse acronym?
        if ($this->start_date !== null) {
            return $this->start_date->copy()->subMonth(1)->startOfMonth();
        }
    }

    public function scopeInYearRange($query, $year)
    {
        $period = (new Carbon)->year($year);

        return $query
            ->where('start_date', '>=', $period->startOfYear()->copy()->addMonth(1))
            ->where('start_date', '<=', $period->endOfYear()->copy()->addMonth(1));
    }

    public function getSpotlightsInYearRange()
    {
        $period = $this->getPeriod();
        if ($period !== null) {
            return Spotlight::monthly()->inYearRange($period->year);
        }
    }

    public function createTables()
    {
        \Log::debug('creating tables');
        // create tables
        DB::connection('mysql-charts')->transaction(function () {
            $modes = array_keys(Beatmap::MODES);
            // beatmapsets
            if ($this->mode_specific) {
                foreach ($modes as $mode) {
                    static::createBeatmapsetTable($this->beatmapsetsTableName($mode));
                }
            } else {
                static::createBeatmapsetTable($this->beatmapsetsTableName('osu'));
            }

            foreach ($modes as $mode) {
                // scores
                static::createBestScoresTable($this->bestScoresTableName($mode));
                // user_stats
                static::createUserStatsTable($this->userStatsTableName($mode));
            }
        });
    }

    public static function getBestOf($year)
    {
        return static::where('acronym', "BEST{$year}")->first();
    }

    public static function newSpotlight(string $acronym, string $name, bool $modeSpecific, string $type = 'monthly')
    {
        /** @var self $spotlight */
        $spotlight = new Spotlight([
            'acronym' => $acronym,
            'name' => $name,
            'mode_specific' => $modeSpecific,
            'type' => $type,
        ]);

        DB::transaction(function () use ($spotlight) {
            $spotlight->createTables();
            $spotlight->saveOrExplode();
        });

        $spotlight->fresh();

        return $spotlight;
    }

    private static function createBeatmapsetTable($name)
    {
        \Log::debug("create table {$name}");

        Schema::connection('mysql-charts')->create($name, function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->unsignedMediumInteger('beatmapset_id')->primary();
        });
    }

    private static function createBestScoresTable($name)
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

    private static function createUserStatsTable($name)
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
