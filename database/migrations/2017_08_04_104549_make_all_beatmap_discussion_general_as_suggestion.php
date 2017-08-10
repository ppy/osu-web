<?php

use Illuminate\Database\Migrations\Migration;

class MakeAllBeatmapDiscussionGeneralAsSuggestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // as of current state, 'suggestion' is 1.
        DB::statement('UPDATE beatmap_discussions SET message_type = 1 WHERE timestamp IS NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('UPDATE beatmap_discussions SET message_type = NULL WHERE timestamp IS NULL');
    }
}
