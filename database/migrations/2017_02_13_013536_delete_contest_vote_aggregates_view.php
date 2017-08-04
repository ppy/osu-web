<?php

use Illuminate\Database\Migrations\Migration;

class DeleteContestVoteAggregatesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new CreateContestVoteAggregatesView)->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new CreateContestVoteAggregatesView)->up();
    }
}
