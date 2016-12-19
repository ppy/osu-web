<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddKudosuRefreshVotesToBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->bigInteger('kudosu_refresh_votes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->dropColumn('kudosu_refresh_votes');
        });
    }
}
