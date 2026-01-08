<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBanchostatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_banchostats')) {
            return;
        }

        Schema::create('osu_banchostats', function (Blueprint $table) {
            $table->increments('banchostats_id');
            $table->smallInteger('users_irc');
            $table->smallInteger('users_osu');
            $table->smallInteger('multiplayer_games');
            $table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_banchostats');
    }
}
