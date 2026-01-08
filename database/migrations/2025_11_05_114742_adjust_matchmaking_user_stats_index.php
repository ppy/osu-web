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
            $table->dropIndex(['first_placements']);
            $table->dropIndex(['total_points']);
            $table->dropIndex(['rating']);
            $table->index(['ruleset_id', 'first_placements']);
            $table->index(['ruleset_id', 'total_points']);
            $table->index(['ruleset_id', 'rating']);
        });
    }

    public function down(): void
    {
        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->index(['first_placements']);
            $table->index(['total_points']);
            $table->index(['rating']);
            $table->dropIndex(['ruleset_id', 'first_placements']);
            $table->dropIndex(['ruleset_id', 'total_points']);
            $table->dropIndex(['ruleset_id', 'rating']);
        });
    }
};
