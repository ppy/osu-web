<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class CreatePollOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('phpbb_poll_options')) {
            return;
        }

        Schema::create('phpbb_poll_options', function ($table) {
            $table->collation = 'utf8_bin';
            $table->charset = 'utf8';

            $table->tinyInteger('poll_option_id')->default(0);
            $table->mediumInteger('topic_id')->unsigned()->default(0);
            $table->text('poll_option_text');
            $table->mediumInteger('poll_option_total')->unsigned()->default(0);

            $table->index('poll_option_id', 'poll_opt_id');
            $table->index('topic_id', 'topic_id');
        });

        DB::statement('ALTER TABLE phpbb_poll_options ROW_FORMAT=DYNAMIC');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phpbb_poll_options');
    }
}
