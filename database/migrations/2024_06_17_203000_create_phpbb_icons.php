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
        if (Schema::hasTable('phpbb_icons')) {
            return;
        }

        Schema::create('phpbb_icons', function (Blueprint $table) {
            $table->mediumIncrements('icons_id');
            $table->string('icons_url')->default('');
            $table->tinyInteger('icons_width')->default(0);
            $table->tinyInteger('icons_height')->default(0);
            $table->unsignedMediumInteger('icons_order')->default(0);
            $table->boolean('display_on_posting')->default(true);

            $table->index(['display_on_posting'], 'display_on_posting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('phpbb_icons');
    }
};
