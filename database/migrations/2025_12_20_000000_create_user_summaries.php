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
        Schema::create('user_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedSmallInteger('year');
            $table->boolean('processed')->default(false);
            $table->json('summary_data')->nullable(true);
            $table->string('share_key');
            $table->timestamps();
            $table->unique(['user_id', 'year']);
            $table->index(['year', 'processed']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_summaries');
    }
};
