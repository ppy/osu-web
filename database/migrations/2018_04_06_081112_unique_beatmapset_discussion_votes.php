<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UniqueBeatmapsetDiscussionVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussion_votes', function ($table) {
            $table->unique(['beatmap_discussion_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussion_votes', function ($table) {
            $table->dropUnique('beatmap_discussion_votes_beatmap_discussion_id_user_id_unique');
        });
    }
}
