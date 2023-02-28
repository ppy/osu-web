<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoloScoresPerformance extends Migration
{
    public function up(): void
    {
        Schema::create('solo_scores_performance', function (Blueprint $table) {
            $table->bigInteger('score_id')->unsigned()->primary();
            $table->double('pp', 8, 2)->nullable()->default(null);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solo_scores_performance');
    }
}
