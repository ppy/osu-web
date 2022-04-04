<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpotlightToOsuBeatmapsets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->boolean('spotlight')->default(false);
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
            $table->dropColumn('spotlight');
        });
    }
}
