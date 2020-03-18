<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ContestSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            //using raw sql because https://github.com/laravel/framework/issues/1186
            //fix ends_at not being nullable (else mysql makes it on_update_current_timestamp)
            DB::statement('ALTER TABLE contests CHANGE ends_at voting_ends_at TIMESTAMP NULL');
            DB::statement('ALTER TABLE contests CHANGE description description_voting TEXT');
        });

        Schema::table('contests', function (Blueprint $table) {
            $table->timestamp('entry_starts_at')->nullable()->after('show_votes');
            $table->timestamp('entry_ends_at')->nullable()->after('entry_starts_at');
            $table->timestamp('voting_starts_at')->nullable()->after('entry_ends_at');

            $table->text('description_enter')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function (Blueprint $table) {
            DB::statement('ALTER TABLE contests CHANGE voting_ends_at ends_at TIMESTAMP NULL');
            DB::statement('ALTER TABLE contests CHANGE description_voting description TEXT');
        });

        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('description_enter');
            $table->dropColumn('voting_starts_at');
            $table->dropColumn('entry_starts_at');
            $table->dropColumn('entry_ends_at');
        });
    }
}
