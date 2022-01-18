<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDefaultBeatmapsBpm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('osu_beatmaps')->whereNull('bpm')->update(['bpm' => -60]);

        Schema::table('osu_beatmaps', function (Blueprint $table) {
            $table->float('bpm')->default(60)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_beatmaps', function (Blueprint $table) {
            $table->float('bpm')->default(null)->nullable()->change();
        });
    }
}
