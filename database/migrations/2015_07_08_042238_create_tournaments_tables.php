<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTournamentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('tournament_id');
            $table->string('name');
            $table->tinyInteger('play_mode')->unsigned()->default(0);
            $table->integer('rank_min')->unsigned()->nullable();
            $table->integer('rank_max')->unsigned()->nullable();
            $table->dateTime('signup_open')->default(DB::raw('NOW()'));
            $table->dateTime('signup_close');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tournaments');
    }
}
