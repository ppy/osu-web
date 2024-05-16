<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_challenge_queue', function (Blueprint $table) {
            $table->id();

            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedSmallInteger('ruleset_id');
            $table->json('allowed_mods')->nullable();
            $table->json('required_mods')->nullable();

            $table->unsignedSmallInteger('order')->nullable();
            $table->unsignedBigInteger('multiplayer_room_id')->nullable();
        });

        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
            'normal',
            'spotlight',
            'featured_artist',
            'daily_challenge'
        ) NOT NULL DEFAULT 'normal'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_challenge');

        DB::statement("ALTER TABLE `multiplayer_rooms` MODIFY `category` ENUM(
            'normal',
            'spotlight',
            'featured_artist'
        ) NOT NULL DEFAULT 'normal'");
    }
};
