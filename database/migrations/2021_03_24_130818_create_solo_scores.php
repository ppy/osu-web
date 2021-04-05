<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoloScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solo_scores', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('user_id');
            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedSmallInteger('ruleset_id');

            $table->enum('rank', ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F'])->nullable();
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

            $table->index(['beatmap_id', 'ruleset_id']);
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
        Schema::dropIfExists('solo_scores');
    }
}
