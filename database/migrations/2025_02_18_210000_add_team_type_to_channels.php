<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddTeamTypeToChannels extends Migration
{
    public function up(): void
    {
        DB::connection('mysql-chat')->statement("ALTER TABLE `channels` MODIFY `type` ENUM(
            'PUBLIC',
            'PRIVATE',
            'MULTIPLAYER',
            'SPECTATOR',
            'TEMPORARY',
            'PM',
            'GROUP',
            'ANNOUNCE',
            'TEAM'
        ) NOT NULL DEFAULT 'TEMPORARY'");
    }

    public function down()
    {
        DB::connection('mysql-chat')->table('channels')->where('type', 'TEAM')->update(['type' => 'TEMPORARY']);
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
}
