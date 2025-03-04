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
        Schema::create('team_statistics', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->unsignedSmallInteger('ruleset_id');
            $table->unsignedBigInteger('performance')->default(0);
            $table->unsignedBigInteger('ranked_score')->default(0);
            $table->unsignedBigInteger('play_count')->default(0);
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();

            $table->primary(['team_id', 'ruleset_id']);
            $table->index(['ruleset_id', 'performance']);
            $table->index(['ruleset_id', 'ranked_score']);
        });
    }

    public function down(): void
    {
        Schema::drop('team_statistics');
    }
};
