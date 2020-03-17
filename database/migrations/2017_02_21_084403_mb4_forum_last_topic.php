<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class Mb4ForumLastTopic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE phpbb_forums MODIFY forum_last_post_subject
                VARCHAR(100)
                NOT NULL
                DEFAULT ''
                COLLATE 'utf8mb4_bin'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE phpbb_forums MODIFY forum_last_post_subject
                VARCHAR(100)
                NOT NULL
                DEFAULT ''
                COLLATE 'utf8_bin'
        ");
    }
}
