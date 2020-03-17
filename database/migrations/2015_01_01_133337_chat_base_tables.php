<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChatBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = Schema::connection('mysql-chat');
        $connection = DB::connection('mysql-chat');

        $builder->create('channels', function (Blueprint $table) {
            $table->charset = 'utf8mb4';

            $table->increments('channel_id');
            $column = $table->string('name', 50);
            $column->charset = 'utf8mb4';
            $table->string('description', 256);
            $table->timestamp('creation_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('type', ['Public', 'Private', 'Multiplayer', 'Spectator', 'Temporary'])->default('Temporary');
            $table->string('allowed_groups', 256)->nullable();

            $table->index('name', 'name');
            $table->index('creation_time', 'creation_time');
        });
        $this->setRowFormat($connection, 'channels', 'DYNAMIC');

        $builder->create('messages', function (Blueprint $table) {
            $table->charset = 'utf8mb4';

            $table->increments('message_id');
            $table->integer('user_id')->unsigned();
            $table->integer('channel_id')->unsigned();
            $table->string('content', 1024)->default('');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['channel_id', 'message_id'], 'channel_id');
            $table->index(['user_id', 'timestamp'], 'user_history');
        });
        $connection->statement('ALTER TABLE `messages` DROP PRIMARY KEY, ADD PRIMARY KEY (`message_id`, `timestamp`)');
        $this->setRowFormat($connection, 'messages', 'COMPRESSED');

        $builder->create('messages_private', function (Blueprint $table) {
            $table->charset = 'utf8mb4';

            $table->increments('message_id');
            $table->integer('user_id')->unsigned();
            $table->integer('target_id')->unsigned();
            $table->string('content', 1024)->default('');
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('user_id', 'user_id');
            $table->index('target_id', 'target_id');
        });
        $connection->statement('ALTER TABLE `messages_private` DROP PRIMARY KEY, ADD PRIMARY KEY (`message_id`, `timestamp`)');
        $this->setRowFormat($connection, 'messages_private', 'COMPRESSED');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $builder = Schema::connection('mysql-chat');

        $builder->drop('channels');
        $builder->drop('messages');
        $builder->drop('messages_private');
    }

    private function setRowFormat($connection, $table, $format)
    {
        $connection->statement("ALTER TABLE `{$table}` ROW_FORMAT={$format};");
    }
}
