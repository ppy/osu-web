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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('short_name')->nullable(false);
            $table->string('logo_file')->nullable(true);
            $table->string('header_file')->nullable(true);
            $table->text('description')->nullable(true);
            $table->boolean('is_open')->nullable(false)->default(true);
            $table->smallInteger('default_ruleset_id')->nullable(false)->default(0);
            $table->bigInteger('leader_id')->nullable(false);
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();

            $table->unique('name');
            $table->unique('short_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
