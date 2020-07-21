<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastScoreIdToMultiplayerRoomsHigh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->bigInteger('last_score_id')->unsigned()->nullable()->after('pp');
        });

        DB::statement('
            UPDATE multiplayer_rooms_high
            SET last_score_id = (
                SELECT MAX(sh.score_id)
                FROM multiplayer_scores_high sh
                JOIN multiplayer_playlist_items pi
                ON (sh.playlist_item_id = pi.id)
                WHERE
                    pi.room_id = multiplayer_rooms_high.room_id
                    AND sh.user_id = multiplayer_rooms_high.user_id
            )
            WHERE
                completed > 0
                AND last_score_id IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->dropColumn('last_score_id');
        });
    }
}
