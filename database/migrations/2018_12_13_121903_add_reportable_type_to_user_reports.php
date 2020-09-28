<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportableTypeToUserReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->enum('reportable_type', ['user', 'comment', 'score_best_osu', 'score_best_taiko', 'score_best_fruits', 'score_best_mania'])->nullable()->after('user_id');
            $table->unsignedBigInteger('reportable_id')->nullable()->after('reportable_type');
            $table->unique(['reporter_id', 'user_id', 'reportable_type', 'reportable_id'], 'unique_reportable');
            $table->index(['reportable_type', 'reportable_id'], 'reportable');
            $table->index(['score_id', 'mode'], 'score');
        });

        DB::statement("UPDATE osu_user_reports SET reportable_type = 'user', reportable_id = user_id WHERE score_id = 0");
        DB::statement("
            UPDATE osu_user_reports SET reportable_id = score_id, reportable_type =
            CASE
                WHEN mode = 0 THEN 'score_best_osu'
                WHEN mode = 1 THEN 'score_best_taiko'
                WHEN mode = 2 THEN 'score_best_fruits'
                WHEN mode = 3 THEN 'score_best_mania'
            END WHERE score_id <> 0");

        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->dropIndex('unique-new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->unique(['reporter_id', 'user_id', 'mode', 'score_id'], 'unique-new');
            $table->dropIndex('unique_reportable');
            $table->dropIndex('reportable');
            $table->dropIndex('score');
            $table->dropColumn('reportable_type');
            $table->dropColumn('reportable_id');
        });
    }
}
