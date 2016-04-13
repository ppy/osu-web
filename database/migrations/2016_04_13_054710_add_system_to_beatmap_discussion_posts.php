<?php

use Illuminate\Database\Migrations\Migration;

class AddSystemToBeatmapDiscussionPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussion_posts', function ($table) {
            $table->boolean('system')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussion_posts', function ($table) {
            $table->dropColumn('system');
        });
    }
}
