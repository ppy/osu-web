<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddAnnounceTypeToChannels extends Migration
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
            'ANNOUNCE'
        ) NOT NULL DEFAULT 'TEMPORARY'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mysql-chat')->statement("UPDATE `channels` SET `type`='TEMPORARY' where `type` = 'ANNOUNCE'");
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
