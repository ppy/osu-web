<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MultiplayerBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-mp');

        $builder->create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->unsignedInteger('match_id');
            $table->unsignedInteger('game_id')->nullable();
            $table->unsignedMediumInteger('user_id')->nullable();
            $table->string('text', 255)->nullable();
            $table->timestamp('timestamp')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['match_id', 'event_id'], 'match_lookup');
        });

        $builder->create('game_scores', function (Blueprint $table) {
            $table->unsignedInteger('game_id');
            $table->unsignedTinyInteger('slot');
            $table->unsignedTinyInteger('team')->default(0);
            $table->unsignedMediumInteger('user_id')->default(0);
            $table->integer('score')->default(0);
            $table->unsignedSmallInteger('maxcombo')->default(0);

            $table->enum('rank', [
                '0', 'A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH',
            ])->default('0');

            $table->unsignedSmallInteger('count50')->default(0);
            $table->unsignedSmallInteger('count100')->default(0);
            $table->unsignedSmallInteger('count300')->default(0);
            $table->unsignedSmallInteger('countmiss')->default(0);
            $table->unsignedSmallInteger('countgeki')->default(0);
            $table->unsignedSmallInteger('countkatu')->default(0);

            $table->tinyInteger('perfect')->default('0');
            $table->tinyInteger('pass')->default('0');

            $table->unsignedBigInteger('frame')->default('0');

            $table->integer('enabled_mods')->nullable();

            $table->primary(['game_id', 'slot']);
        });

        $builder->create('games', function ($table) {
            $table->increments('game_id');
            $table->unsignedInteger('match_id')->nullable();
            $table->timestamp('start_time')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('end_time')->nullable();
            $table->unsignedMediumInteger('beatmap_id')->nullable();
            $table->unsignedTinyInteger('play_mode')->nullable();
            $table->unsignedTinyInteger('match_type')->nullable();
            $table->unsignedTinyInteger('scoring_type')->nullable();
            $table->unsignedTinyInteger('team_type')->nullable();
            $table->unsignedBigInteger('mods')->nullable();

            $table->index('match_id', 'match_lookup');
        });

        $builder->create('matches', function ($table) {
            $table->increments('match_id');
            $table->timestamp('start_time')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('name', 255);

            $table->index('end_time', 'time');
        });

        $connection = DB::connection('mysql-mp');

        $connection->statement('ALTER TABLE `matches` ADD private BIT(1) NOT NULL');
        $connection->statement("ALTER TABLE `matches` ADD keep_forever BIT(1) DEFAULT b'0' NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-mp');

        $builder->drop('events');
        $builder->drop('game_scores');
        $builder->drop('games');
        $builder->drop('matches');
    }
}
