<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserZebrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('phpbb_zebra')) {
            return;
        }

        Schema::create('phpbb_zebra', function (Blueprint $table) {
            $table->mediumInteger('user_id')->unsigned()->default(0);
            $table->mediumInteger('zebra_id')->unsigned()->default(0);
            $table->tinyInteger('friend')->unsigned()->default(0);
            $table->tinyInteger('foe')->unsigned()->default(0);

            $table->primary(['user_id', 'zebra_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phpbb_zebra');
    }
}
