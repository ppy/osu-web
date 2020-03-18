<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
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
            $table->index('topic_id');
            $table->dropUnique('forum_topic_covers_topic_id_unique');
        });
    }
}
