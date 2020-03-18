<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
