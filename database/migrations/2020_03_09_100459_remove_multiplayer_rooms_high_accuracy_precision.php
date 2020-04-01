<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMultiplayerRoomsHighAccuracyPrecision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->float('accuracy')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // raw because change() won't add precision.
        DB::statement('ALTER TABLE multiplayer_rooms_high MODIFY COLUMN accuracy double(5, 4) NOT NULL DEFAULT 0');
    }
}
