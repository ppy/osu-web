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
        Schema::create('user_country_history', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->char('year_month', 4);
            $table->char('country_acronym', 2);
            $table->unsignedInteger('count')->default(1);
            $table->timestamp('last_updated')->useCurrent()->useCurrentOnUpdate();
            $table->primary(['user_id', 'year_month', 'country_acronym']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_country_history');
    }
};
