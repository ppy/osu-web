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
            $table->dropPrimary(['user_id', 'ruleset_id']);
            $table->unsignedInteger('pool_id')->after('user_id');
        });

        // Best effort: mania will assume user stats correspond to 7K.
        DB::statement("UPDATE matchmaking_user_stats s SET s.pool_id = (SELECT MAX(id) FROM matchmaking_pools p WHERE p.ruleset_id = s.ruleset_id)");

        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropColumn('ruleset_id');
            $table->primary(['user_id', 'pool_id']);
        });
    }

    public function down(): void
    {
        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropPrimary(['user_id', 'pool_id']);
            $table->smallInteger('ruleset_id')->after('user_id');
        });

        DB::statement("UPDATE matchmaking_user_stats s SET s.ruleset_id = (SELECT ruleset_id FROM matchmaking_pools p WHERE p.id = s.pool_id)");

        Schema::table('matchmaking_user_stats', function (Blueprint $table) {
            $table->dropColumn('pool_id');
            $table->primary(['user_id', 'ruleset_id']);
        });
    }
};
