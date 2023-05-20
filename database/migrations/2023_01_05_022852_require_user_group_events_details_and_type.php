<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\UserGroupEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RequireUserGroupEventsDetailsAndType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // The format of `details` before this was not finalised, and on
        // production nothing important was logged anyway. No going back!
        UserGroupEvent::truncate();

        Schema::table('user_group_events', function (Blueprint $table) {
            $table->json('details')->nullable(false)->change();
        });
        DB::statement("ALTER TABLE user_group_events CHANGE type type ENUM(
            'group_add',
            'group_remove',
            'group_rename',
            'user_add',
            'user_add_playmodes',
            'user_remove',
            'user_remove_playmodes',
            'user_set_default'
        ) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_group_events', function (Blueprint $table) {
            $table->json('details')->nullable()->change();
        });
        DB::statement("ALTER TABLE user_group_events CHANGE type type ENUM(
            'group_add',
            'group_remove',
            'group_rename',
            'user_add',
            'user_add_playmodes',
            'user_remove',
            'user_remove_playmodes',
            'user_set_default'
        )");
    }
}
