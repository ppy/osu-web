<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class AddRealtimeToMultiplayerRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE multiplayer_rooms
                       MODIFY COLUMN category
                       ENUM('normal', 'spotlight', 'realtime')
                       NOT NULL DEFAULT 'normal'");
        DB::statement("ALTER TABLE multiplayer_rooms
                       MODIFY COLUMN ends_at
                       TIMESTAMP NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE multiplayer_rooms
                       MODIFY COLUMN category
                       ENUM('normal', 'spotlight')
                       NOT NULL DEFAULT 'normal'");
        DB::statement("ALTER TABLE multiplayer_rooms
                       MODIFY COLUMN ends_at
                       TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
    }
}
