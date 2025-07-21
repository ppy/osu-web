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
        Schema::table('osu_events', function (Blueprint $table) {
            $table->boolean('legacy_score_event')->nullable();
            $table->index(['user_id', 'event_id', 'legacy_score_event'], 'user_id_legacy_score_event');
            $table->dropIndex('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osu_events', function (Blueprint $table) {
            $table->index(['user_id', 'event_id'], 'user_id');
            $table->dropIndex('user_id_legacy_score_event');
            $table->dropColumn('legacy_score_event');
        });
    }
};
