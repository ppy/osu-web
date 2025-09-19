<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const string DEFAULT = '2000-01-01 00:00:00';

    public function up(): void
    {
        DB::table('daily_challenge_user_stats')->whereNull('last_percentile_calculation')->update([
            'last_percentile_calculation' => static::DEFAULT,
        ]);

        Schema::table('daily_challenge_user_stats', function (Blueprint $table) {
            $columns = [
                'last_update',
                'last_percentile_calculation',
                'last_weekly_streak',
            ];
            foreach ($columns as $column) {
                $table->timestamp($column)->default(static::DEFAULT)->nullable(false)->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('daily_challenge_user_stats', function (Blueprint $table) {
            $table->timestamp('last_percentile_calculation')->nullable(true)->default(null)->change();
            $table->timestamp('last_update')->useCurrent()->change();
            $table->timestamp('last_weekly_streak')->useCurrent()->change();
        });
    }
};
