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
        Schema::table('daily_challenge_user_stats', function (Blueprint $table) {
            $table->timestamp('last_percentile_calculation')->nullable(true);
            $table->timestamp('last_update')->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_challenge_user_stats', function (Blueprint $table) {
            $table->dropColumn('last_percentile_calculation');
            $table->timestamp('last_update')->useCurrent()->useCurrentOnUpdate()->change();
        });
    }
};
