<?php

use Illuminate\Database\Migrations\Migration;

class AddBeatmapDiscussionPostToReportTypes extends Migration
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
                       enum('user', 'comment', 'score_best_osu', 'score_best_taiko', 'score_best_fruits', 'score_best_mania', 'beatmapset_discussion_post')");
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
                       enum('user', 'comment', 'score_best_osu', 'score_best_taiko', 'score_best_fruits', 'score_best_mania')");
    }
}
