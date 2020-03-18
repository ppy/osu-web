<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddKudosuBlockToBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->boolean('kudosu_denied')->default(false);
            $table->unsignedMediumInteger('kudosu_denied_by_id')->nullable();
            $table->foreign('kudosu_denied_by_id')
                ->references('user_id')
                ->on('phpbb_users')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->dropColumn('kudosu_denied');
            $table->dropForeign(['kudosu_denied_by_id']);
            $table->dropColumn('kudosu_denied_by_id');
        });
    }
}
