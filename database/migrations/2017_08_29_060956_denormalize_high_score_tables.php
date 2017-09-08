<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DenormalizeHighScoreTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (['', '_mania', '_fruits', '_taiko'] as $mode) {
            Schema::table("osu_scores{$mode}_high", function ($table) {
                $table->dropColumn('beatmapset_id');
                $table->boolean('hidden')->default(false);
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
        foreach (['', '_mania', '_fruits', '_taiko'] as $mode) {
            Schema::table("osu_scores{$mode}_high", function ($table) {
                $table->unsignedMediumInteger('beatmapset_id')->default(0);
                $table->dropColumn('hidden');
                $table->dropColumn('country_acronym');
            });
        }
    }
}
