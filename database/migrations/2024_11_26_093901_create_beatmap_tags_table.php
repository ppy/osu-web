<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('beatmap_tags', function (Blueprint $table) {
            $table->unsignedInteger('beatmap_id');
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->primary(['beatmap_id', 'tag_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beatmap_tags');
    }
};
