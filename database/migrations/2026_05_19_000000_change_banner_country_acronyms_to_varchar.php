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
        Schema::table('osu_profile_banners', function (Blueprint $table) {
            $table->string('country_acronym', 255)->change();
        });

        Schema::table('tournament_banners', function (Blueprint $table) {
            $table->string('winner_country_acronym', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('osu_profile_banners', function (Blueprint $table) {
            $table->char('country_acronym', 2)->change();
        });

        Schema::table('tournament_banners', function (Blueprint $table) {
            $table->char('winner_country_acronym', 2)->change();
        });
    }
};
