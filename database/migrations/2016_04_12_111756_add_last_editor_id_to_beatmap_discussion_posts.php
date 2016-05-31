<?php

use Illuminate\Database\Migrations\Migration;

class AddLastEditorIdToBeatmapDiscussionPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussion_posts', function ($table) {
            $table->mediumInteger('last_editor_id')->unsigned()->nullable();

            $table->foreign('last_editor_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('SET NULL');
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
            $table->dropForeign(['last_editor_id']);

            $table->dropColumn('last_editor_id');
        });
    }
}
