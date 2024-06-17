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
        Schema::table('user_profile_customizations', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable(false)->default(null)->change();
            $table->dropColumn('id');
            $table->primary('user_id');
            $table->dropIndex('user_profile_customizations_user_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profile_customizations', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable(false)->default(0)->change();
            $table->unique('user_id');
            $table->dropPrimary('user_id');
        });

        Schema::table('user_profile_customizations', function (Blueprint $table) {
            $table->increments('id')->first();
        });
    }
};
