<?php

use Illuminate\Database\Migrations\Migration;

class AddBroadcastTypeToChannels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql-chat')->statement("ALTER TABLE `channels` MODIFY `type` ENUM(
            'PUBLIC',
            'PRIVATE',
            'MULTIPLAYER',
            'SPECTATOR',
            'TEMPORARY',
            'PM',
            'GROUP',
            'BROADCAST'
        ) NOT NULL DEFAULT 'TEMPORARY'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mysql-chat')->statement("UPDATE `channels` SET `type`='TEMPORARY' where `type` = 'BROADCAST'");
        DB::connection('mysql-chat')->statement("ALTER TABLE `channels` MODIFY `type` ENUM(
            'PUBLIC',
            'PRIVATE',
            'MULTIPLAYER',
            'SPECTATOR',
            'TEMPORARY',
            'PM',
            'GROUP'
        ) NOT NULL DEFAULT 'TEMPORARY'");
    }
}
