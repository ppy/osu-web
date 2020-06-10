<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserStatsMania4k7k extends Migration
{
    const VARIANTS = ['4k', '7k'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (static::VARIANTS as $k) {
            Schema::create("osu_user_stats_mania_{$k}", function (Blueprint $table) {
                $table->integer('user_id')->unsigned()->nullable(false);
                $table->mediumInteger('playcount')->nullable(false);
                $table->mediumInteger('x_rank_count')->nullable(false);
                $table->mediumInteger('xh_rank_count')->nullable()->default(0);
                $table->mediumInteger('s_rank_count')->nullable(false);
                $table->mediumInteger('sh_rank_count')->nullable()->default(0);
                $table->mediumInteger('a_rank_count')->nullable(false);
                $table->char('country_acronym', 2)->nullable(false)->default('');
                $table->float('rank_score')->nullable(false);
                $table->integer('rank_score_index')->unsigned()->nullable(false);
                $table->float('accuracy_new')->unsigned()->nullable(false);
                $table->timestamp('last_update')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
                $table->timestamp('last_played')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));

                $table->primary('user_id');
                $table->index(['country_acronym', 'rank_score'], 'country_acronym_2');
                $table->index('playcount', 'playcount');
                $table->index('rank_score', 'rank_score');
            });
            DB::statement("ALTER TABLE osu_user_stats_mania_{$k} CHANGE rank_score rank_score float unsigned NOT NULL");
            DB::statement("ALTER TABLE osu_user_stats_mania_{$k} CHANGE accuracy_new accuracy_new float unsigned NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (static::VARIANTS as $k) {
            Schema::drop("osu_user_stats_mania_{$k}");
        }
    }
}
