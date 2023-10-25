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
        Schema::table('solo_score_tokens', function (Blueprint $table) {
            $table->unsignedBigInteger('playlist_item_id')->nullable(true)->after('ruleset_id');

            // for attempts count in start play assertion
            $table->index(['user_id', 'playlist_item_id']);
        });
    }

    public function down(): void
    {
        Schema::table('solo_score_tokens', function (Blueprint $table) {
            $table->dropColumn('playlist_item_id');
        });
    }
};
