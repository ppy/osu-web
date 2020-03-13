<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddNewRankCacheColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_user_stats', function ($table) {
            $table->mediumInteger('xh_rank_count')->default(0)->after('x_rank_count');
            $table->mediumInteger('sh_rank_count')->default(0)->after('s_rank_count');
        });

        Schema::table('osu_user_stats_taiko', function ($table) {
            $table->mediumInteger('xh_rank_count')->default(0)->after('x_rank_count');
            $table->mediumInteger('sh_rank_count')->default(0)->after('s_rank_count');
        });

        Schema::table('osu_user_stats_fruits', function ($table) {
            $table->mediumInteger('xh_rank_count')->default(0)->after('x_rank_count');
            $table->mediumInteger('sh_rank_count')->default(0)->after('s_rank_count');
        });

        Schema::table('osu_user_stats_mania', function ($table) {
            $table->mediumInteger('xh_rank_count')->default(0)->after('x_rank_count');
            $table->mediumInteger('sh_rank_count')->default(0)->after('s_rank_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_user_stats', function ($table) {
            $table->dropColumn('xh_rank_count');
            $table->dropColumn('sh_rank_count');
        });

        Schema::table('osu_user_stats_taiko', function ($table) {
            $table->dropColumn('xh_rank_count');
            $table->dropColumn('sh_rank_count');
        });

        Schema::table('osu_user_stats_fruits', function ($table) {
            $table->dropColumn('xh_rank_count');
            $table->dropColumn('sh_rank_count');
        });

        Schema::table('osu_user_stats_mania', function ($table) {
            $table->dropColumn('xh_rank_count');
            $table->dropColumn('sh_rank_count');
        });
    }
}
