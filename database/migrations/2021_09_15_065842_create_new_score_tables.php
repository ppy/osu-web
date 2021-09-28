<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewScoreTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solo_scores_process_history', function (Blueprint $table) {
            $table->bigInteger('score_id');
            $table->tinyInteger('processed_version');
            $table->timestampTz('processed_at')->useCurrent()->useCurrentOnUpdate();

            $table->primary('score_id');
        });

        Schema::drop('solo_scores');
        Schema::create('solo_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->mediumInteger('beatmap_id')->unsigned();
            $table->smallInteger('ruleset_id')->unsigned();
            $table->json('data');
            $table->boolean('preserve')->default(false);
            $table->timestampsTz();
            $table->softDeletes();

            $table->index('preserve');
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
        Schema::dropIfExists('solo_scores_process_history');
        Schema::dropIfExists('solo_scores');
        (new CreateSoloScores())->up();
    }
}
