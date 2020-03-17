<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSoftDeletesToPostsTopicsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phpbb_posts', function (Blueprint $table) {
            $table->softDeletes();
            $table->index('deleted_at');
            $table->dropIndex('topic_id');
            $table->index(['topic_id', 'deleted_at'], 'topic_id_deleted');
        });

        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->softDeletes();
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phpbb_posts', function (Blueprint $table) {
            $table->dropIndex('topic_id_deleted');
            $table->dropColumn('deleted_at');
            $table->index('topic_id', 'topic_id');
        });

        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
