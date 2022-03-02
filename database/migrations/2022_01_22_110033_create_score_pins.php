<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScorePins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_pins', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->enum('score_type', [
                'score_best_fruits',
                'score_best_mania',
                'score_best_osu',
                'score_best_taiko',
            ]);
            $table->bigInteger('score_id')->unsigned();
            $table->float('display_order');
            $table->timestampsTz();

            $table->unique(['user_id', 'score_type', 'score_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_pins');
    }
}
