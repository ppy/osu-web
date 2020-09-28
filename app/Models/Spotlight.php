<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Models\Score\Best as ScoreBest;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Schema;

/**
 * @property string $acronym
 * @property bool $active
 * @property int $chart_id
 * @property \Carbon\Carbon|null $chart_month
 * @property \Carbon\Carbon|null $end_date
 * @property bool $mode_specific
 * @property string $name
 * @property \Carbon\Carbon|null $start_date
 * @property string $type
 */
class Spotlight extends Model
{
    const PERIODIC_TYPES = ['bestof', 'monthly'];
    const SPOTLIGHT_MAX_RESULTS = 40;

    public $timestamps = false;

    protected $table = 'osu_charts';
    protected $primaryKey = 'chart_id';
    protected $guarded = [];

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
        $model = new $clazz();
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
        $model = new $clazz();
        $model->setTable($this->userStatsTableName($mode));
        $model->setConnection('mysql-charts');

        return $model->newQuery();
    }

    public function hasMode(string $mode)
    {
        return Schema::connection('mysql-charts')->hasTable($this->userStatsTableName($mode));
    }

    public function participantCount(string $mode)
    {
        return $this->userStats($mode)->count();
    }

    public function ranking(string $mode)
    {
        // These models will not have the correct table name set on them
        // as they get overriden when Laravel hydrates them.
        return $this->userStats($mode)
            ->with(['user', 'user.country'])
            ->whereHas('user', function ($userQuery) {
                $model = new User();
                $userQuery
                    ->from($model->tableName(true))
                    ->default();
            })
            ->orderBy('ranked_score', 'desc')
            ->limit(static::SPOTLIGHT_MAX_RESULTS);
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
