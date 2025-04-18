<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->enum('reportable_type', [
                'user',
                'comment',
                'score_best_osu',
                'score_best_taiko',
                'score_best_fruits',
                'score_best_mania',
                'beatmapset_discussion_post',
                'forum_post',
                'beatmapset',
                'solo_score',
                'message',
                'team',
            ])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->enum('reportable_type', [
                'user',
                'comment',
                'score_best_osu',
                'score_best_taiko',
                'score_best_fruits',
                'score_best_mania',
                'beatmapset_discussion_post',
                'forum_post',
                'beatmapset',
                'solo_score',
                'message',
            ])->nullable()->change();
        });
    }
};
