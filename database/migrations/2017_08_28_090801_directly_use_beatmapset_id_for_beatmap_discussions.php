<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DirectlyUseBeatmapsetIdForBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->unsignedMediumInteger('beatmapset_id')->after('id')->nullable();

            $table->foreign('beatmapset_id')
                ->references('beatmapset_id')
                ->on('osu_beatmapsets')
                ->onDelete('RESTRICT');
        });

        DB::statement('UPDATE beatmap_discussions b SET beatmapset_id = (SELECT beatmapset_id FROM beatmapset_discussions s WHERE s.id = b.beatmapset_discussion_id)');

        Schema::table('beatmap_discussions', function ($table) {
            $table->dropForeign('beatmap_discussions_beatmapset_discussion_id_foreign');
            $table->dropColumn('beatmapset_discussion_id');
        });
        DB::statement('ALTER TABLE beatmap_discussions MODIFY beatmapset_id MEDIUMINT UNSIGNED NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->unsignedBigInteger('beatmapset_discussion_id')->nullable();
            $table->foreign('beatmapset_discussion_id')
                ->references('id')
                ->on('beatmapset_discussions')
                ->onDelete('RESTRICT');
        });

        DB::statement('UPDATE beatmap_discussions b SET beatmapset_discussion_id = (SELECT id FROM beatmapset_discussions s WHERE s.beatmapset_id = b.beatmapset_id)');

        Schema::table('beatmap_discussions', function ($table) {
            $table->dropForeign('beatmap_discussions_beatmapset_id_foreign');
            $table->dropColumn('beatmapset_id');
            $table->unsignedBigInteger('beatmapset_discussion_id')->change();
        });
    }
}
