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
        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->boolean('pinned')->default(false);
            $table->string('description')->nullable();

            $table->index('pinned');

            $table->index(['user_id', 'pinned']);
            $table->dropIndex(['user_id']);

            $table->index(['category', 'ends_at', 'pinned']);
            $table->dropIndex(['category', 'ends_at']);

            $table->index(['category', 'user_id', 'pinned']);
            $table->dropIndex(['category', 'user_id']);

            $table->index(['ends_at', 'pinned']);
            $table->dropIndex(['ends_at']);

            $table->index(['type', 'category', 'ends_at', 'pinned']);
            $table->dropIndex(['type', 'category', 'ends_at']);
        });

        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->index(['room_id', 'in_room', 'user_id', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->dropIndex(['room_id', 'in_room', 'user_id', 'updated_at']);
        });

        Schema::table('multiplayer_rooms', function (Blueprint $table) {
            $table->dropIndex(['pinned']);

            $table->index(['user_id']);
            $table->dropIndex(['user_id', 'pinned']);

            $table->index(['category', 'ends_at']);
            $table->dropIndex(['category', 'ends_at', 'pinned']);

            $table->index(['category', 'user_id']);
            $table->dropIndex(['category', 'user_id', 'pinned']);

            $table->index(['ends_at']);
            $table->dropIndex(['ends_at', 'pinned']);

            $table->index(['type', 'category', 'ends_at']);
            $table->dropIndex(['type', 'category', 'ends_at', 'pinned']);

            $table->dropColumn(['pinned', 'description']);
        });
    }
};
