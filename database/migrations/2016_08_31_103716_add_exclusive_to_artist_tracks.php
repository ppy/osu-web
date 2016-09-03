<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExclusiveToArtistTracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artist_tracks', function (Blueprint $table) {
            $table->boolean('exclusive')->after('length')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artist_tracks', function (Blueprint $table) {
            $table->dropColumn('exclusive');
        });
    }
}
