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
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->unsignedBigInteger('score_link_id')->nullable()->after('score_id');
            $table->index(['playlist_item_id', DB::raw('total_score DESC'), 'score_link_id'], 'top_scores_linked');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->dropIndex('top_scores_linked');
            $table->dropColumn('score_link_id');
        });
    }
};
