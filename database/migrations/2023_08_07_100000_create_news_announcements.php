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
        Schema::create('news_announcements', function (Blueprint $table): void {
            $table->mediumIncrements('id');
            $table->text('content_markdown')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->string('image_url');
            $table->tinyInteger('order');
            $table->timestamp('started_at')->useCurrent();
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_announcements');
    }
};
