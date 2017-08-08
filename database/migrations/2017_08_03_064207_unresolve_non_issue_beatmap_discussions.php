<?php

use Illuminate\Database\Migrations\Migration;

class UnresolveNonIssueBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // as of current state, 'problem' is 2, and 'suggestion' is 1.
        DB::statement('UPDATE beatmap_discussions SET resolved = false WHERE message_type NOT IN (1, 2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // ha ha ha
    }
}
