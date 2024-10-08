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
        Schema::create('score_replay_stats', function (Blueprint $table) {
            $table->bigInteger('score_id')->unsigned()->primary();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('watch_count')->unsigned()->default(0);
            $table->index(['user_id', 'watch_count']);
            $table->index('watch_count');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('score_replay_stats');
    }
};
