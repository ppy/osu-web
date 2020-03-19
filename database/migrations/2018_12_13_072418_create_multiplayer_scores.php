<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiplayerScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiplayer_scores', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedMediumInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('playlist_item_id');
            $table->unsignedMediumInteger('beatmap_id');

            $table->char('rank', 2)->nullable();
            $table->unsignedMediumInteger('total_score')->nullable();
            $table->double('accuracy', 5, 4)->nullable();
            $table->float('pp')->nullable();
            $table->unsignedMediumInteger('max_combo')->nullable();
            $table->json('mods')->nullable();
            $table->json('statistics')->nullable();

            $table->timestampTz('started_at')->useCurrent();
            $table->timestampTz('ended_at')->nullable();

            $table->boolean('passed')->nullable();

            $table->timestampsTz();
            $table->softDeletes();

            $table->index('room_id');
            $table->index('playlist_item_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('multiplayer_scores');
    }
}
