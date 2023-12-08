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
        Schema::create('contest_judge_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('contest_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('max_value')->default(10);
            $table->timestamps();

            $table->unique(['contest_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contest_judge_categories');
    }
};
