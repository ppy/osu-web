<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddModeChangesToUserGroupEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE user_group_events CHANGE type type ENUM(
            'group_add',
            'group_remove',
            'group_rename',
            'user_add',
            'user_add_modes',
            'user_remove',
            'user_remove_modes',
            'user_set_default'
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE user_group_events CHANGE type type ENUM(
            'group_add',
            'group_remove',
            'group_rename',
            'user_add',
            'user_remove',
            'user_set_default'
        )");
    }
}
