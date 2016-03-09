<?php

use Illuminate\Database\Migrations\Migration;

class ChangePrimaryKeyOnSlackUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_slack_users', function ($table) {
            $table->dropPrimary('slack_id_primary');
            $table->primary('user_id');
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
            $table->dropPrimary('osu_slack_users_user_id_primary');
            $table->primary('slack_id');
        });
    }
}
