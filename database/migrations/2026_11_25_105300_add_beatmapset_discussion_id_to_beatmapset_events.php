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
        Schema::table('beatmapset_events', function (Blueprint $table) {
            $table->unsignedBigInteger('beatmapset_discussion_id')->after('beatmapset_id')->nullable();
            $table->index(['user_id', 'type', 'beatmapset_discussion_id'], 'user_discussion_count');
        });
    }

    public function down(): void
    {
        Schema::table('beatmapset_events', function (Blueprint $table) {
            $table->dropIndex('user_discussion_count');
            $table->dropColumn('beatmapset_discussion_id');
        });
    }
};
