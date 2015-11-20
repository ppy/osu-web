<?php

use Illuminate\Database\Migrations\Migration;

class AddUniqueIndexToForumTopicCoversForumId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_topic_covers', function ($table) {
            $table->unique('topic_id');
            $table->dropIndex('forum_topic_covers_topic_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_topic_covers', function ($table) {
            $table->dropUnique('forum_topic_covers_topic_id_unique');
            $table->index('topic_id');
        });
    }
}
