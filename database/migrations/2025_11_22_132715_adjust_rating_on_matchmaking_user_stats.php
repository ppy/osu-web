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
        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->integer('rating')->virtualAs("ROUND(JSON_EXTRACT(elo_data, '$.approximate_posterior.mu'), 0)");
            $table->index(['pool_id', 'rating']);
        });
    }

    public function down(): void
    {
        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropIndex(['pool_id', 'rating']);
            $table->dropColumn('rating');
        });
    }
};
