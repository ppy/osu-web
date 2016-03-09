<?php

use Illuminate\Database\Migrations\Migration;

class AddIndexOnSlackId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_slack_users', function ($table) {
            $table->index('slack_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_slack_users', function ($table) {
            $table->dropIndex('osu_slack_users_slack_id_index');
        });
    }
}
