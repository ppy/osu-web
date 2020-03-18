<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-chat');
        $builder->create('user_channels', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('channel_id');
            $table->unsignedInteger('last_read_id')->nullable();

            $table->unique(['user_id', 'channel_id']);
            $table->index('channel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-chat');
        $builder->drop('user_channels');
    }
}
