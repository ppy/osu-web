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
        // This is a legacy table. Migration is added for external projects' sake.
        if (Schema::hasTable('osu_logins')) {
            return;
        }

        Schema::create('osu_logins', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->default(0);
            $table->string('ip', 100)->default('');
            $table->timestamp('date')->useCurrent();

            $table->index('user_id');
            $table->index('date');
            $table->index('ip');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
