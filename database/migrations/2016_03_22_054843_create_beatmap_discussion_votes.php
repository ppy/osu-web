<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBeatmapDiscussionVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmap_discussion_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('beatmap_discussion_id')->unsigned();
            $table->mediumInteger('user_id')->unsigned()->nullable();
            $table->tinyInteger('score');
            $table->nullableTimestamps();

            $table->foreign('beatmap_discussion_id')
                ->references('id')
                ->on('beatmap_discussions')
                ->onDelete('RESTRICT');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beatmap_discussion_votes');
    }
}
