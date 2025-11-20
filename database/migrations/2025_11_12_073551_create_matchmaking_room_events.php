<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matchmaking_room_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id');
            $table->string('event_type');
            $table->bigInteger('playlist_item_id')->nullable()
                ->comment('This normally maps to multiplayer_playlist_items, but can also be -1 to indicate a "random" selection.');
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
            $table->json('event_detail')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matchmaking_room_events');
    }
};
