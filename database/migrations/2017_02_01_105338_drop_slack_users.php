<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSlackUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('osu_slack_users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        (new CreateOsuSlackUsersTable)->up();
        (new ChangePrimaryKeyOnSlackUsers)->up();
        (new OsuSlackUserMakeSlackIdNullable)->up();
        (new AddIndexOnSlackId)->up();
    }
}
