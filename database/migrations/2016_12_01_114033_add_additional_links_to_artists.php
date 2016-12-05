<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalLinksToArtists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('bandcamp')->after('soundcloud')->nullable();
            $table->string('patreon')->after('bandcamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('bandcamp');
            $table->dropColumn('patreon');
        });
    }
}
