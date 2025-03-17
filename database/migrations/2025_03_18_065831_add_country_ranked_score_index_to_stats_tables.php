<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLES = [
        'osu_user_stats',
        'osu_user_stats_fruits',
        'osu_user_stats_mania',
        'osu_user_stats_taiko',
    ];

    const TABLE_VARIANTS = [
        'osu_user_stats_mania_4k',
        'osu_user_stats_mania_7k',
    ];

    public function up(): void
    {
        foreach (static::TABLE_VARIANTS as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->bigInteger('ranked_score')->default(0)->after('rank_score_index');
            });
        }

        foreach ([...static::TABLES, ...static::TABLE_VARIANTS] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->index(['country_acronym', 'ranked_score'], 'country_ranked_score');
            });
        }
    }

    public function down(): void
    {
        foreach ([...static::TABLES, ...static::TABLE_VARIANTS] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropIndex('country_ranked_score');
            });
        }

        foreach (static::TABLE_VARIANTS as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('ranked_score');
            });
        }
    }
};
