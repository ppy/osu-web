<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlbumIdToArtistTracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artist_tracks', function (Blueprint $table) {
            $table->integer('album_id')->unsigned()->after('artist_id')->nullable();
            $table->foreign('album_id')
                ->references('id')
                ->on('artist_albums')
                ->onDelete('set null');
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
            $table->dropForeign('artist_tracks_album_id_foreign');
            $table->dropColumn('album_id');
        });
    }
}
