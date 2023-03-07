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
        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->index([
                'forum_id',
                'topic_type',
                DB::raw('topic_time DESC'),
                DB::raw('topic_last_post_time DESC'),
            ], 'created_sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phpbb_topics', function (Blueprint $table) {
            $table->dropIndex('created_sort');
        });
    }
};
