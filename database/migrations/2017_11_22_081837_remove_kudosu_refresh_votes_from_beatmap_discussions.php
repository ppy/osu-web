<?php

use Illuminate\Database\Migrations\Migration;

class RemoveKudosuRefreshVotesFromBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new AddKudosuRefreshVotesToBeatmapDiscussions)->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new AddKudosuRefreshVotesToBeatmapDiscussions)->up();
    }
}
