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
        Schema::create('user_cover_presets', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('filename')->nullable(true);
            $table->boolean('active')->default(false)->nullable(false);
            $table->timestamps();
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_cover_presets');
    }
};
