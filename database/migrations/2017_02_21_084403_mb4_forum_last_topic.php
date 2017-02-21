<?php

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
