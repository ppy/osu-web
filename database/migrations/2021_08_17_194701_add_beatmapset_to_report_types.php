<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddBeatmapsetToReportTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE osu_user_reports
                       MODIFY COLUMN reportable_type
                       enum('user', 'comment', 'score_best_osu', 'score_best_taiko', 'score_best_fruits', 'score_best_mania', 'beatmapset_discussion_post', 'forum_post', 'beatmapset')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE osu_user_reports
                       MODIFY COLUMN reportable_type
                       enum('user', 'comment', 'score_best_osu', 'score_best_taiko', 'score_best_fruits', 'score_best_mania', 'beatmapset_discussion_post', 'forum_post')");
    }
}
