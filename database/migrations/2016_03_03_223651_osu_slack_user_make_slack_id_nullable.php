<?php

use Illuminate\Database\Migrations\Migration;

class OsuSlackUserMakeSlackIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_slack_users', function ($table) {
            $table->string('slack_id', 50)->nullable()->change();
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
            $table->string('slack_id', 50)->change();
        });
    }
}
