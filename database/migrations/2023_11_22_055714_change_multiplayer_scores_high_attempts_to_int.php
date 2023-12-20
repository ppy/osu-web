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
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->unsignedInteger('attempts')->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('multiplayer_scores_high', function (Blueprint $table) {
            $table->unsignedTinyInteger('attempts')->default(0)->change();
        });
    }
};
