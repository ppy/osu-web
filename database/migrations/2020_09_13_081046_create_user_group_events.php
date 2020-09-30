<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actor_id')->unsigned()->nullable();
            $table->timestamp('created_at');
            $table->json('details')->nullable();
            $table->mediumInteger('group_id')->unsigned();
            $table->boolean('hidden')->default(false);
            $table->enum('type', [
                'group_add',
                'group_remove',
                'group_rename',
                'user_add',
                'user_remove',
                'user_set_default',
            ]);
            $table->integer('user_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_group_events');
    }
}
