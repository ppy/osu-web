<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
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
