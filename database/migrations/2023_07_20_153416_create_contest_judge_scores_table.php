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
        Schema::create('contest_judge_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('contest_judge_vote_id')->unsigned();
            $table->integer('contest_judge_category_id')->unsigned();
            $table->tinyInteger('value');
            $table->timestamps();

            $table->index('contest_judge_vote_id');
            $table->index('contest_judge_category_id');
            $table->unique(['contest_judge_vote_id', 'contest_judge_category_id'], 'vote_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contest_judge_scores');
    }
};
