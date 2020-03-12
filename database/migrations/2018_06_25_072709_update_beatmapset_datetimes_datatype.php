<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class UpdateBeatmapsetDatetimesDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE osu_beatmapsets
            MODIFY COLUMN approved_date TIMESTAMP NULL DEFAULT NULL,
            MODIFY COLUMN submit_date TIMESTAMP NULL DEFAULT NULL,
            MODIFY COLUMN thread_icon_date TIMESTAMP NULL DEFAULT NULL,
            MODIFY COLUMN cover_updated_at TIMESTAMP NULL DEFAULT NULL,
            MODIFY COLUMN queued_at TIMESTAMP NULL DEFAULT NULL
        ');
        // some of the times were in UTC+8
        DB::statement('UPDATE osu_beatmapsets SET
            approved_date = DATE_SUB(approved_date, INTERVAL 8 HOUR),
            submit_date = DATE_SUB(submit_date, INTERVAL 8 HOUR),
            thread_icon_date = DATE_SUB(thread_icon_date, INTERVAL 8 HOUR)
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE osu_beatmapsets
            MODIFY COLUMN approved_date DATETIME NULL DEFAULT NULL,
            MODIFY COLUMN submit_date DATETIME NULL DEFAULT NULL,
            MODIFY COLUMN thread_icon_date DATETIME NULL DEFAULT NULL,
            MODIFY COLUMN cover_updated_at DATETIME NULL DEFAULT NULL,
            MODIFY COLUMN queued_at DATETIME NULL DEFAULT NULL
        ');
        DB::statement('UPDATE osu_beatmapsets SET
            approved_date = DATE_ADD(approved_date, INTERVAL 8 HOUR),
            submit_date = DATE_ADD(submit_date, INTERVAL 8 HOUR),
            thread_icon_date = DATE_ADD(thread_icon_date, INTERVAL 8 HOUR)
        ');
    }
}
