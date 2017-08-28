<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscussionEnabledToBeatmapsets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmapsets', function ($table) {
            $table->boolean('discussion_enabled')->default(false);
        });

        DB::statement('UPDATE osu_beatmapsets s SET discussion_enabled = true WHERE beatmapset_id IN (SELECT beatmapset_id FROM beatmapset_discussions d WHERE s.beatmapset_id = d.beatmapset_id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_beatmapsets', function ($table) {
            $table->dropColumn('discussion_enabled');
        });
    }
}
