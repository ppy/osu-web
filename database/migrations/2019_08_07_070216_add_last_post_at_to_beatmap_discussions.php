<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastPostAtToBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->timestamp('last_post_at')->nullable();
        });

        // use the current updated_at timestamp as last_post_at's initial value
        DB::statement('UPDATE beatmap_discussions SET last_post_at = updated_at');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussions', function (Blueprint $table) {
            $table->dropColumn('last_post_at');
        });
    }
}
