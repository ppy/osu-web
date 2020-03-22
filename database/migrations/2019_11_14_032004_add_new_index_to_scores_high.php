<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewIndexToScoresHigh extends Migration
{
    const TABLES = [
        'osu_scores_high',
        'osu_scores_taiko_high',
        'osu_scores_fruits_high',
        'osu_scores_mania_high',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (static::TABLES as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->boolean('hidden')->default(false);
                $table->dropIndex('beatmap_score_lookup');
                $table->index(['beatmap_id', 'hidden', DB::raw('score DESC'), 'score_id'], 'beatmap_score_lookup_v2');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (static::TABLES as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndex('beatmap_score_lookup_v2');
                $table->index(['beatmap_id', 'score', 'user_id'], 'beatmap_score_lookup');
                $table->dropColumn('hidden');
            });
        }
    }
}
