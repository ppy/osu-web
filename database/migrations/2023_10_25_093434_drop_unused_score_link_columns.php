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
        Schema::table('multiplayer_score_links', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('room_id');
            $table->dropColumn('beatmap_id');
            $table->dropColumn('build_id');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->primary('score_id');
            $table->dropIndex(['score_id']);
            $table->dropIndex('multiplayer_score_links_room_id_user_id_index');
        });
    }

    public function down(): void
    {
        Schema::table('multiplayer_score_links', function (Blueprint $table) {
            $table->dropPrimary('score_id');
        });
        Schema::table('multiplayer_score_links', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->unsignedBigInteger('room_id')->after('user_id')->nullable(true);
            $table->unsignedMediumInteger('beatmap_id')->after('playlist_item_id')->nullable(true);
            $table->unsignedMediumInteger('build_id')->after('beatmap_id')->nullable(false)->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->index(['score_id']);
            $table->index(['room_id', 'user_id']);
        });
    }
};
