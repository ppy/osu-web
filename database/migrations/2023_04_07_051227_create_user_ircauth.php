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
        Schema::create('osu_user_ircauth', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->string('token', 50)->nullable();
            $table->timestampTz('timestamp')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->unique('token', 'token');
            $table->index('timestamp', 'timestamp');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osu_user_ircauth');
    }
};
