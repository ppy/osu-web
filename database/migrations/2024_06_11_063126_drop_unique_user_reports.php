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
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->dropIndex('unique_reportable');
            $table->index(['reporter_id', 'user_id', 'reportable_type', 'reportable_id'], 'user_report');
        });
    }

    public function down(): void
    {
        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->dropIndex('user_report');
            $table->unique(['reporter_id', 'user_id', 'reportable_type', 'reportable_id'], 'unique_reportable');
        });
    }
};
