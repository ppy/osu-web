<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

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
        (new CreateOsuSlackUsersTable())->up();
        (new ChangePrimaryKeyOnSlackUsers())->up();
        (new OsuSlackUserMakeSlackIdNullable())->up();
        (new AddIndexOnSlackId())->up();
    }
}
