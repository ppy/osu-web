<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoresHighUserBeatmapRankScoreIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_scores_high', function (Blueprint $table) {
            $table->index(['user_id', 'beatmap_id', 'rank', 'score'], 'user_beatmap_rank_score');
        });

        // Doctrine still doesn't support enum in tables, so using Schema to check if the index exists explodes.
        if (DB::select("SHOW INDEX FROM osu_scores_high WHERE KEY_NAME = 'user_beatmap_rank'") !== []) {
            DB::statement("DROP INDEX user_beatmap_rank ON osu_scores_high");
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_scores_high', function (Blueprint $table) {
            $table->index(['user_id', 'beatmap_id', 'rank'], 'user_beatmap_rank');
        });

        Schema::table('osu_scores_high', function (Blueprint $table) {
            $table->dropIndex('user_beatmap_rank_score');
        });
    }
}
