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
        Schema::create('tournament_banners', function (Blueprint $table) {
            $table->unsignedMediumInteger('tournament_id')->primary();
            $table->boolean('is_active')->default(false);
            $table->char('winner_country_acronym', 2)->nullable(true);
            $table->string('banner_url_prefix');
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_banners');
    }
};
