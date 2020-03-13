<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            $table->bigIncrements('id');

            $table->unsignedBigInteger('room_id');
            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedSmallInteger('playlist_order')->nullable();

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
