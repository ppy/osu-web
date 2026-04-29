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
        Schema::table('matchmaking_pool_beatmaps', function (Blueprint $table) {
            $table->double('rating')->default(1500)->change();
            $table->double('rating_sig')->after('rating')->default(150);

            $table->dropColumn('mods');
            $table->string('mods')->after('beatmap_id')->default('');

            $table->unique(['pool_id', 'beatmap_id', 'mods'], 'key_pool_id_beatmap_id_mods');
        });
    }

    public function down(): void
    {
        Schema::table('matchmaking_pool_beatmaps', function (Blueprint $table) {
            $table->dropUnique('key_pool_id_beatmap_id_mods');

            $table->dropColumn('mods');
            $table->json('mods')->after('beatmap_id')->nullable();

            $table->integer('rating')->default(1500)->change();
            $table->dropColumn('rating_sig');
        });
    }
};
