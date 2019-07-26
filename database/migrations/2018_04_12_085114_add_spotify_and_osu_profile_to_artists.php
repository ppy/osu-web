<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddSpotifyAndOsuProfileToArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artists', function ($table) {
            $table->string('spotify')->after('patreon')->nullable();
            $table->mediumInteger('user_id')->unsigned()->nullable()->after('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function ($table) {
            $table->dropColumn('spotify');
            $table->dropColumn('user_id');
        });
    }
}
