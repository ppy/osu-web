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
        Schema::create('daily_challenge_user_stats', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->unsignedMediumInteger('playcount')->default(0);
            $table->unsignedMediumInteger('daily_streak_current')->default(0);
            $table->unsignedMediumInteger('daily_streak_best')->default(0);
            $table->unsignedMediumInteger('weekly_streak_current')->default(0);
            $table->unsignedMediumInteger('weekly_streak_best')->default(0);
            $table->unsignedMediumInteger('top_10p_placements')->default(0);
            $table->unsignedMediumInteger('top_50p_placements')->default(0);
            $table->timestamp('last_weekly_streak')->useCurrent();
            $table->timestamp('last_update')->useCurrent()->useCurrentOnUpdate();
            $table->index(['last_weekly_streak', 'last_update']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_challenge_user_stats');
    }
};
