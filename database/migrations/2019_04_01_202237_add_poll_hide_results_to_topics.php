<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPollHideResultsToTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->boolean('poll_hide_results')->after('poll_vote_change')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->dropColumn('poll_hide_results');
        });
    }
}
