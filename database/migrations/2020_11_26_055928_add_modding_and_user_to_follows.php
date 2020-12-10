<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddModdingAndUserToFollows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE follows
                       MODIFY COLUMN notifiable_type
                       enum('beatmapset', 'build', 'news_post', 'user')");
        DB::statement("ALTER TABLE follows
                       MODIFY COLUMN subtype
                       enum('comment', 'modding')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE follows
                       MODIFY COLUMN notifiable_type
                       enum('beatmapset', 'build', 'news_post')");
        DB::statement("ALTER TABLE follows
                       MODIFY COLUMN subtype
                       enum('comment')");
    }
}
