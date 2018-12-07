<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiplayer_playlist_items', function (Blueprint $table) {
            $table->bigInteger('room_id')->unsigned();

            $table->mediumInteger('beatmap_id')->unsigned();
            $table->smallInteger('playlist_order')->unsigned()->nullable();

            $table->json('allowed_mods')->nullable();
            $table->json('required_mods')->nullable();

            $table->timestampsTz();

            $table->index('room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('multiplayer_playlist_items');
    }
}
