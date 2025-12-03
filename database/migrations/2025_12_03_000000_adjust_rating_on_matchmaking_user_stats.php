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
            $table->integer('rating')->storedAs("ROUND(JSON_EXTRACT(elo_data, '$.approximate_posterior.mu'), 0)");
            $table->integer('plays')->storedAs("JSON_EXTRACT(elo_data, '$.contest_count')");
            $table->dropIndex(['pool_id', 'total_points']);
            $table->index(['pool_id', 'plays', 'rating', 'total_points'], 'pool_rating');
            $table->index(['pool_id', 'plays', 'total_points', 'rating'], 'pool_points');
        });
    }

    public function down(): void
    {
        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropIndex('pool_rating');
            $table->dropIndex('pool_points');
            $table->dropColumn('rating');
            $table->dropColumn('plays');
            $table->index(['pool_id', 'total_points']);
        });
    }
};
