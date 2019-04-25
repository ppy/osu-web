<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscussionLockedToBeatmapsets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_beatmapsets', function (Blueprint $table) {
            $table->boolean('discussion_locked')->after('discussion_enabled')->default(0);
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
            $table->dropColumn('discussion_locked');
        });
    }
}
