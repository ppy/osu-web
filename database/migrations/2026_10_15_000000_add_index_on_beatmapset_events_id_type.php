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
            $table->dropIndex('beatmapset_events_beatmapset_id_foreign');
            $table->index(['beatmapset_id', 'type', \DB::raw('created_at DESC')], 'beatmapset_events_beatmapset_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('beatmapset_events', function (Blueprint $table) {
            $table->index(['beatmapset_id'], 'beatmapset_events_beatmapset_id_foreign');
            $table->dropIndex('beatmapset_events_beatmapset_id_index');
        });
    }
};
