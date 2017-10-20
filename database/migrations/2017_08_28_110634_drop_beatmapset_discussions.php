<?php

use Illuminate\Database\Migrations\Migration;

class DropBeatmapsetDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        (new CreateBeatmapsetDiscussions())->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new CreateBeatmapsetDiscussions())->up();
    }
}
