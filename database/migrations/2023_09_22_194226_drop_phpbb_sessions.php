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
        migration('2016_08_16_101048_create_sessions_table')->down();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        migration('2016_08_16_101048_create_sessions_table')->up();

        // Relevant part of 2020_05_15_083037_sync_structure
        Schema::table('phpbb_sessions', function (Blueprint $table) {
            $table->integer('session_user_id')->unsigned()->default(0)->change();
        });
    }
};
