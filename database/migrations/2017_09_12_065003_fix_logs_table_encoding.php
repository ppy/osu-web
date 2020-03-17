<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class FixLogsTableEncoding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE phpbb_log MODIFY log_data MEDIUMTEXT NOT NULL COLLATE 'utf8mb4_bin'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE phpbb_log MODIFY log_data MEDIUMTEXT NOT NULL COLLATE 'utf8_bin'");
    }
}
