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
        Schema::table('github_users', function (Blueprint $table): void {
            $table->unsignedBigInteger('canonical_id')->change();
            $table->string('username')->change();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('github_users', function (Blueprint $table): void {
            $table->unsignedBigInteger('canonical_id')->nullable()->change();
            $table->string('username')->nullable()->change();

            $table->dropUnique('github_users_user_id_unique');
        });
    }
};
