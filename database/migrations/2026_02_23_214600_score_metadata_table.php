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
        Schema::create('score_metadata', function (Blueprint $table) {
            $table->unsignedInteger('score_id');
            $table->integer('rank_delta');
            $table->integer('pp_delta');
            $table->timestamps();
            $table->unique(['score_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('score_metadata');
    }
};
