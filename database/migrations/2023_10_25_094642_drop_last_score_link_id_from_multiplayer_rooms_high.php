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
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->dropColumn('last_score_link_id');
        });
    }

    public function down(): void
    {
        Schema::table('multiplayer_rooms_high', function (Blueprint $table) {
            $table->unsignedBigInteger('last_score_link_id')->after('last_score_id')->nullable(true);
        });
    }
};
