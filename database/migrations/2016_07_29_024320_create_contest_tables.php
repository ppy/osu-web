<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContestTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['art', 'beatmap', 'music']);
            $table->tinyInteger('max_votes')->default(3);

            $table->string('header_url');

            $table->timestamp('ends_at');
            $table->timestamps();
        });

        Schema::create('contest_entries', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');
            $table->string('name');
            $table->string('masked_name');

            $table->string('entry_url');

            $table->integer('contest_id')->unsigned();
            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onDelete('restrict');

            $table->timestamps();
        });

        Schema::create('contest_votes', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('id');

            $table->integer('contest_id')->unsigned();
            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onDelete('restrict');

            $table->mediumInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('restrict');

            $table->integer('contest_entry_id')->unsigned();
            $table->foreign('contest_entry_id')
                ->references('id')
                ->on('contest_entries')
                ->onDelete('restrict');

            $table->tinyInteger('weight')->unsigned()->default(1);

            $table->unique(['contest_id', 'user_id', 'contest_entry_id']);

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
        Schema::drop('contest_votes');
        Schema::drop('contest_entries');
        Schema::drop('contests');
    }
}
