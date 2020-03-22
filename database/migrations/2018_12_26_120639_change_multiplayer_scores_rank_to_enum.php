<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class ChangeMultiplayerScoresRankToEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `multiplayer_scores` MODIFY `rank` ENUM('A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH', 'F') NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `multiplayer_scores` MODIFY `rank` char(2) NULL');
    }
}
