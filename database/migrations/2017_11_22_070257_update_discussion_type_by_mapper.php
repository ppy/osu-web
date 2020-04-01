<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class UpdateDiscussionTypeByMapper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('beatmap_discussions')
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('osu_beatmapsets')
                    ->whereRaw('beatmap_discussions.beatmapset_id = osu_beatmapsets.beatmapset_id')
                    ->whereRaw('beatmap_discussions.user_id = osu_beatmapsets.user_id');
            })
            ->update(['message_type' => 3]);
    }

    /**
     * Reverse the migrations.
     * Doesn't quite roll back because they could be praise/suggestion/problem.
     *
     * @return void
     */
    public function down()
    {
        DB::table('beatmap_discussions')
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('osu_beatmapsets')
                    ->whereRaw('beatmap_discussions.beatmapset_id = osu_beatmapsets.beatmapset_id')
                    ->whereRaw('beatmap_discussions.user_id = osu_beatmapsets.user_id');
            })
            ->update(['message_type' => 1]);
    }
}
