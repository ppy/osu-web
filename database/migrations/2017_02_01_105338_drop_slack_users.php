<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

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
        migration('2016_02_27_103851_create_osu_slack_users_table')->up();
        migration('2016_03_02_214730_change_primary_key_on_slack_users')->up();
        migration('2016_03_03_223651_osu_slack_user_make_slack_id_nullable')->up();
        migration('2016_03_09_083112_add_index_on_slack_id')->up();
    }
}
