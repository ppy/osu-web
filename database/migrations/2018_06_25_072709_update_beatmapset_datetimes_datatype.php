<?php

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
            MODIFY COLUMN approved_date TIMESTAMP DEFAULT NULL,
            MODIFY COLUMN submit_date TIMESTAMP DEFAULT NULL,
            MODIFY COLUMN thread_icon_date TIMESTAMP DEFAULT NULL,
            MODIFY COLUMN cover_updated_at TIMESTAMP DEFAULT NULL,
            MODIFY COLUMN queued_at TIMESTAMP DEFAULT NULL
        ');
        // some of the times were in UTC+8
        DB::statement('UPDATE osu_beatmapsets SET
            approved_date = IF(approved_date IS NULL, NULL, DATE_SUB(approved_date, INTERVAL 8 HOUR)),
            submit_date = IF(submit_date IS NULL, NULL, DATE_SUB(submit_date, INTERVAL 8 HOUR)),
            thread_icon_date = IF(thread_icon_date IS NULL, NULL, DATE_SUB(thread_icon_date, INTERVAL 8 HOUR))
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
            MODIFY COLUMN approved_date DATETIME DEFAULT NULL,
            MODIFY COLUMN submit_date DATETIME DEFAULT NULL,
            MODIFY COLUMN thread_icon_date DATETIME DEFAULT NULL,
            MODIFY COLUMN cover_updated_at DATETIME DEFAULT NULL,
            MODIFY COLUMN queued_at DATETIME DEFAULT NULL
        ');
        DB::statement('UPDATE osu_beatmapsets SET
            approved_date = IF(approved_date IS NULL, NULL, DATE_ADD(approved_date, INTERVAL 8 HOUR)),
            submit_date = IF(submit_date IS NULL, NULL, DATE_ADD(submit_date, INTERVAL 8 HOUR)),
            thread_icon_date = IF(thread_icon_date IS NULL, NULL, DATE_ADD(thread_icon_date, INTERVAL 8 HOUR))
        ');
    }
}
