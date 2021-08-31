<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBundledFlagsToBeatmapsets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->boolean('bundled')->default(false);
            $table->boolean('can_bundle')->default(false);
            $table->index('bundled');
            $table->index('can_bundle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->dropIndex(['bundled']);
            $table->dropIndex(['can_bundle']);
            $table->dropColumn('bundled');
            $table->dropColumn('can_bundle');
        });
    }
}
