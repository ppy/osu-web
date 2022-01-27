<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInRoomToMultiplayerRoomsHigh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->boolean('in_room')->default(false)->after('last_score_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->dropColumn('in_room');
        });
    }
}
