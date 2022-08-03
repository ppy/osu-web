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
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('beatmap_leaders', function (Blueprint $table) {
            $table->unsignedBigInteger('score_id');
            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedSmallInteger('ruleset_id');
            $table->unsignedInteger('user_id');
            $table->unique(['beatmap_id', 'ruleset_id']);
            $table->index(['user_id', 'ruleset_id']);
            $table->primary('score_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('beatmap_leaders');
    }
};
