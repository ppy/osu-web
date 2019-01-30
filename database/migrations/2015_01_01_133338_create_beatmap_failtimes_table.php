<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
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
