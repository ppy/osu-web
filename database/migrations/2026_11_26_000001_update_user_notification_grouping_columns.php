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
        \Artisan::call('user-notifications:copy-columns');

        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('notifiable_type', 255)->nullable(false)->change();
            $table->unsignedBigInteger('notifiable_id')->nullable(false)->change();
            $table->string('category', 255)->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('notifiable_type', 255)->nullable()->change();
            $table->unsignedBigInteger('notifiable_id')->nullable()->change();
            $table->string('category', 255)->nullable()->change();
        });
    }
};
