<?php

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
            $table->dropColumn('bundled');
            $table->dropColumn('can_bundle');
        });
    }
}
