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
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->timestampTz('ends_at')->nullable();
            $table->index([DB::raw('ends_at DESC'), DB::raw('room_id DESC'), 'user_id'], 'participated_rooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->dropColumn('ends_at');
            $table->dropIndex('participated_rooms');
        });
    }
};
