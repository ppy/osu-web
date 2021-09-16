<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBeatmapsetDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beatmapset_discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumInteger('beatmapset_id')->unsigned();
            $table->timestamps();

            $table->unique('beatmapset_id');

            $table->foreign('beatmapset_id')
                ->references('beatmapset_id')
                ->on('osu_beatmapsets')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beatmapset_discussions');
    }
}
