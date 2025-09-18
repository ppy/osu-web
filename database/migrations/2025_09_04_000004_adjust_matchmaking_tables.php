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
        Schema::table('matchmaking_pools', function (Blueprint $table) {
            $table->smallInteger('variant_id')->after('ruleset_id')->default(0);

            $table->dropIndex(['ruleset_id', 'active']);
            $table->index(['ruleset_id', 'variant_id', 'active']);
        });

        Schema::table('matchmaking_pool_beatmaps', function (Blueprint $table) {
            $table->unsignedMediumInteger('beatmap_id')->after('pool_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matchmaking_pools', function (Blueprint $table) {
            $table->dropColumn('variant_id');

            $table->dropIndex(['ruleset_id', 'variant_id', 'active']);
            $table->index(['ruleset_id', 'active']);
        });

        Schema::table('matchmaking_pool_beatmaps', function (Blueprint $table) {
            $table->smallInteger('beatmap_id')->after('pool_id')->change();
        });
    }
};
