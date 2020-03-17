<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddDiscussionEnabledToBeatmapsets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmapsets', function ($table) {
            $table->boolean('discussion_enabled')->default(false);
        });

        DB::statement('UPDATE osu_beatmapsets s SET discussion_enabled = true WHERE beatmapset_id IN (SELECT beatmapset_id FROM beatmapset_discussions d WHERE s.beatmapset_id = d.beatmapset_id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_beatmapsets', function ($table) {
            $table->dropColumn('discussion_enabled');
        });
    }
}
