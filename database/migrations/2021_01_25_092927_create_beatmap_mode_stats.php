<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateBeatmapModeStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE IF NOT EXISTS osu_beatmap_mode_stats (
            `beatmap_id` int unsigned NOT NULL,
            `mode` tinyint unsigned NOT NULL DEFAULT 0,
            `ss_ratio` float DEFAULT NULL,
            `relative_difficulty` float unsigned DEFAULT NULL,
            `relative_playcount` float unsigned DEFAULT NULL,
            `unique_users` mediumint unsigned DEFAULT NULL,
            `average_accuracy` double unsigned DEFAULT NULL,
            `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`beatmap_id`,`mode`),
            KEY `mode` (`mode`)
        )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osu_beatmap_mode_stats');
    }
}
