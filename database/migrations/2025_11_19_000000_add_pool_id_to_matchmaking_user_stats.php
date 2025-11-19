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
            $table->dropIndex(['ruleset_id', 'first_placements']);
            $table->dropIndex(['ruleset_id', 'total_points']);
            $table->dropIndex(['ruleset_id', 'rating']);
            $table->dropPrimary();

            // Unused column.
            $table->dropColumn('rating');

            $table->unsignedInteger('pool_id')->after('user_id');
            $table->index(['pool_id', 'first_placements']);
            $table->index(['pool_id', 'total_points']);
        });

        // This is a best-effort attempt to convert from ruleset_id to pool_id.
        // Prior to this migration, each user has a single stats row per ruleset, but mania has multiple pools that share the same ruleset.
        // Mania 4K (the most common variant) has a lower id in production, so this will assume 4K as the user's stats.
        DB::statement('UPDATE matchmaking_user_stats s SET s.pool_id = (SELECT MIN(id) FROM matchmaking_pools p WHERE p.ruleset_id = s.ruleset_id)');

        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropColumn('ruleset_id');
            $table->primary(['user_id', 'pool_id']);
        });
    }

    public function down(): void
    {
        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropIndex(['pool_id', 'first_placements']);
            $table->dropIndex(['pool_id', 'total_points']);
            $table->dropPrimary();

            $table->integer('rating');

            $table->smallInteger('ruleset_id');
            $table->index(['ruleset_id', 'first_placements']);
            $table->index(['ruleset_id', 'total_points']);
            $table->index(['ruleset_id', 'rating']);
        });

        // Attempt to enforce uniqueness of the ruleset_id column by converting from pool_id.
        // This will only work if the table doesn't have any new data.
        DB::statement('UPDATE matchmaking_user_stats s SET s.ruleset_id = (SELECT ruleset_id FROM matchmaking_pools p WHERE p.id = s.pool_id)');

        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropColumn('pool_id');
            $table->primary(['user_id', 'ruleset_id']);
        });
    }
};
