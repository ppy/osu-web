<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLovedPolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loved_polls', function (Blueprint $table) {
            $table->unsignedMediumInteger('topic_id');
            $table->unsignedMediumInteger('beatmapset_id');
            $table->unsignedInteger('description_author_id')->nullable();
            $table->text('excluded_beatmap_ids');
            $table->decimal('pass_threshold', 2, 2);
            $table->unsignedSmallInteger('ruleset_id');

            $table->primary('topic_id');
            $table
                ->foreign('beatmapset_id')
                ->references('beatmapset_id')
                ->on('osu_beatmapsets')
                ->cascadeOnDelete();
            $table
                ->foreign('description_author_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->nullOnDelete();
            $table
                ->foreign('topic_id')
                ->references('topic_id')
                ->on('phpbb_topics')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loved_polls');
    }
}
