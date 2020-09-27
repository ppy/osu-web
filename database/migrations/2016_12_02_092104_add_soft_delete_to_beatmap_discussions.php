<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToBeatmapDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beatmap_discussions', function ($table) {
            $table->softDeletes();
            $table->unsignedMediumInteger('deleted_by_id')->nullable();
            $table->foreign('deleted_by_id')
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
            $table->dropSoftDeletes();
            $table->dropForeign(['deleted_by_id']);
            $table->dropColumn('deleted_by_id');
        });
    }
}
