<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeatmapDifficulty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_beatmap_difficulty')) {
            return;
        }

        Schema::create('osu_beatmap_difficulty', function (Blueprint $table) {
            $table->charset = 'utf8mb4';

            $table->unsignedInteger('beatmap_id');
            $table->tinyInteger('mode')->default(0);
            $table->unsignedInteger('mods');
            $table->float('diff_unified', null, null); // creates a double instead of float.
            $table->timestamp('last_update');

            $table->primary(['beatmap_id', 'mode', 'mods'], 'osu_beatmap_difficulty_primary');
            $table->index(['mode', 'mods', 'diff_unified'], 'diff_sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_beatmap_difficulty');
    }
}
