<?php

use Illuminate\Database\Migrations\Migration;

class CreateContestVoteAggregatesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW contest_vote_aggregates AS SELECT contest_id, contest_entry_id, count(*) as votes FROM contest_votes GROUP BY contest_entry_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW contest_vote_aggregates');
    }
}
