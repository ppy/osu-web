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
            $table->after('delivery', function (Blueprint $table) {
                $table->string('notifiable_type', 255)->nullable();
                $table->unsignedBigInteger('notifiable_id')->nullable();
                $table->string('category', 255)->nullable();
            });
            $table->index(['user_id', 'delivery', 'is_read', 'notifiable_type', 'notifiable_id', 'category', 'notification_id'], 'user_notifications_grouping');
        });
    }

    public function down(): void
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            $table->dropIndex('user_notifications_grouping');
            $table->dropColumn('notifiable_type');
            $table->dropColumn('notifiable_id');
            $table->dropColumn('category');
        });
    }
};
