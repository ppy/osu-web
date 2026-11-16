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
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->string('notifiable_type', 255)->nullable();
            $table->unsignedBigInteger('notifiable_id')->nullable();
            $table->string('category', 255)->nullable();
            $table->index(['user_id', 'is_read', 'notifiable_type', 'notifiable_id', 'category', 'notification_id'], 'user_read_grouping');
            $table->dropIndex('user_read');
        });

        // TODO: should probably be separate steps
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
            $table->index(['user_id', 'is_read'], 'user_read');
            $table->dropIndex('user_read_grouping');
            $table->dropColumn('notifiable_type');
            $table->dropColumn('notifiable_id');
            $table->dropColumn('category');
        });
    }
};
