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
        Schema::create('multiplayer_score_links', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('playlist_item_id');
            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedMediumInteger('build_id')->default(0);
            $table->unsignedBigInteger('score_id')->nullable();

            $table->timestampsTz();

            $table->index('score_id');
            $table->index(['room_id', 'user_id']);
            $table->index('playlist_item_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiplayer_score_links');
    }
};
