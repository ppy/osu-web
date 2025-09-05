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
        Schema::create('matchmaking_user_stats', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable(false);
            $table->smallInteger('ruleset_id')->nullable(false);
            $table->unsignedInteger('first_placements')->default(0);
            $table->unsignedInteger('total_points')->default(0);
            $table->timestamps();

            $table->primary(['user_id', 'ruleset_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchmaking_user_stats');
    }
};
