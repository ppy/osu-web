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
        Schema::create('beatmap_owners', function (Blueprint $table) {
            $table->unsignedMediumInteger('beatmap_id');
            $table->unsignedInteger('user_id');
            $table->primary(['beatmap_id', 'user_id']);
            $table->index(['user_id', 'beatmap_id'], 'user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beatmap_owners');
    }
};
