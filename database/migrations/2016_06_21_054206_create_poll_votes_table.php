<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class CreatePollVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('phpbb_poll_votes')) {
            return;
        }

        Schema::create('phpbb_poll_votes', function ($table) {
            $table->collation = 'utf8_bin';
            $table->charset = 'utf8';

            $table->mediumInteger('topic_id')->unsigned()->default(0);
            $table->tinyInteger('poll_option_id')->default(0);
            $table->mediumInteger('vote_user_id')->unsigned()->default(0);
            $table->string('vote_user_ip', 40)->default('');

            $table->index('topic_id', 'topic_id');
            $table->index('vote_user_id', 'vote_user_id');
            $table->index('vote_user_ip', 'vote_user_ip');
        });

        DB::statement('ALTER TABLE phpbb_poll_votes ROW_FORMAT=DYNAMIC');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phpbb_poll_votes');
    }
}
