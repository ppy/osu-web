<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBeatmapFailtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Checking whether the table already exists
        // so it doesn't break when migrating on production
        if (Schema::hasTable('osu_beatmap_failtimes')) {
            return;
        }

        Schema::create('osu_beatmap_failtimes', function (Blueprint $table) {
            $table->mediumInteger('beatmap_id');
            $table->enum('type', ['fail', 'exit']);
            for ($i = 1; $i <= 100; $i++) {
                $table->mediumInteger("p{$i}")->unsigned()->default(0);
            }

            $table->primary(['beatmap_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_beatmap_failtimes');
    }
}
