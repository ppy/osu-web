<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsuDifficultyAttribs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osu_difficulty_attribs', function (Blueprint $table) {
            $table->unsignedSmallInteger('attrib_id');
            $table->string('name', 256)->default('');
            $table->boolean('visible')->default(0);
            $table->primary('attrib_id');
        });

        DB::table('osu_difficulty_attribs')->insert([
            ['attrib_id' => 1, 'name' => 'Aim', 'visible' => 1],
            ['attrib_id' => 3, 'name' => 'Speed', 'visible' => 1],
            ['attrib_id' => 5, 'name' => 'OD', 'visible' => 0],
            ['attrib_id' => 7, 'name' => 'AR', 'visible' => 0],
            ['attrib_id' => 9, 'name' => 'Max combo', 'visible' => 0],
            ['attrib_id' => 11, 'name' => 'Strain', 'visible' => 1],
            ['attrib_id' => 13, 'name' => 'Hit window 300', 'visible' => 0],
            ['attrib_id' => 15, 'name' => 'Score multiplier', 'visible' => 0],
            ['attrib_id' => 17, 'name' => 'Flashlight', 'visible' => 0],
            ['attrib_id' => 19, 'name' => 'Slider factor', 'visible' => 0],
            ['attrib_id' => 21, 'name' => 'Speed note count', 'visible' => 0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osu_difficulty_attribs');
    }
}
