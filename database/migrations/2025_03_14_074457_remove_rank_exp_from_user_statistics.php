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
        'osu_user_stats_mania_4k',
        'osu_user_stats_mania_7k',
        'osu_user_stats_taiko',
    ];

    public function up(): void
    {
        foreach (static::TABLES as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropIndex('rank_score_exp');
                $table->dropIndex('country_acronym_exp');
                $table->dropColumn('rank_score_exp');
                $table->dropColumn('rank_score_index_exp');
            });
        }
    }

    public function down(): void
    {
        foreach (static::TABLES as $table) {
            DB::statement("ALTER TABLE {$table} ADD rank_score_exp float unsigned NOT NULL DEFAULT 0 AFTER rank_score_index");

            Schema::table($table, function (Blueprint $table) {
                $table->unsignedInteger('rank_score_index_exp')->default(0)->after('rank_score_exp');
                $table->index(['rank_score_exp'], 'rank_score_exp');
                $table->index(['country_acronym', 'rank_score_exp'], 'country_acronym_exp');
            });
        }
    }
};
