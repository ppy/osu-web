<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlaymodeToOsuBeatmappacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmappacks', function (Blueprint $table) {
            $table->unsignedTinyInteger('playmode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_beatmappacks', function (Blueprint $table) {
            $table->dropColumn('playmode');
        });
    }
}
