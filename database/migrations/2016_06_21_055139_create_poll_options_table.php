<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

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
            $table->tinyInteger('poll_option_id')->default(0);
            $table->mediumInteger('topic_id')->unsigned()->default(0);
            $table->text('poll_option_text');
            $table->mediumInteger('poll_option_total')->unsigned()->default(0);

            $table->index('poll_option_id', 'poll_opt_id');
            $table->index('topic_id', 'topic_id');
        });
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
