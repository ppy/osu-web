<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmap_discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('beatmapset_discussion_id')->unsigned();
            $table->mediumInteger('beatmap_id')->unsigned()->nullable();
            $table->mediumInteger('user_id')->unsigned()->nullable();

            $table->integer('message_type')->nullable();
            $table->integer('timestamp')->nullable();
            $table->boolean('resolved')->default(false);

            $table->nullableTimestamps();

            $table->foreign('beatmapset_discussion_id')
                ->references('id')
                ->on('beatmapset_discussions')
                ->onDelete('RESTRICT');

            $table->foreign('beatmap_id')
                ->references('beatmap_id')
                ->on('osu_beatmaps')
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
        Schema::drop('beatmap_discussions');
    }
}
