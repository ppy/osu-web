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
        Schema::table('tags', function (Blueprint $table) {
            $table->smallInteger('ruleset_id')->nullable()->unsigned()->after('name');
            $table->dropIndex('tags_name_unique');
            $table->unique(['name', 'ruleset_id'], 'tags_name_ruleset_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropIndex('tags_name_ruleset_id_unique');
            $table->unique('name', 'tags_name_unique');
            $table->dropColumn('ruleset_id');
        });
    }
};
