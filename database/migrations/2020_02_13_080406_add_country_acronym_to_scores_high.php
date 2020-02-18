<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryAcronymToScoresHigh extends Migration
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
                $table->char('country_acronym', 2)->default('');
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
                $table->dropColumn('country_acronym');
            });
        }
    }
}
