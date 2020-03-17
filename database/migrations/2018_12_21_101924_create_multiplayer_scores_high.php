<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiplayerScoresHigh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiplayer_scores_high', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('score_id');
            $table->unsignedMediumInteger('user_id');
            $table->unsignedBigInteger('playlist_item_id');
            $table->unsignedMediumInteger('total_score')->default(0);
            $table->double('accuracy', 5, 4)->default(0);
            $table->float('pp')->nullable()->default(0);

            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();

            $table->unique(['user_id', 'playlist_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('multiplayer_scores_high');
    }
}
