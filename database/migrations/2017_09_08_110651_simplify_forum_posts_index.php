<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class SimplifyForumPostsIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phpbb_posts', function ($table) {
            $table->index('topic_id', 'topic_id');
            $table->dropIndex('topic_id_deleted');
            $table->dropIndex('phpbb_posts_deleted_at_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phpbb_posts', function ($table) {
            $table->index(['topic_id', 'deleted_at'], 'topic_id_deleted');
            $table->index('deleted_at', 'phpbb_posts_deleted_at_index');
            $table->dropIndex('topic_id', 'topic_id');
        });
    }
}
