<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private static function applyAll(?callable $callback): void
    {
        static $suffixes = [
            '',
            '_fruits',
            '_mania',
            '_mania_4k',
            '_mania_7k',
            '_taiko',
        ];

        foreach ($suffixes as $suffix) {
            Schema::table("osu_user_stats{$suffix}", $callback);
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        static::applyAll(function (Blueprint $table): void {
            $table->unsignedFloat('rank_score_exp')->default(0)->after('rank_score_index');
            $table->unsignedInteger('rank_score_index_exp')->default(0)->after('rank_score_exp');
            $table->index(['rank_score_exp'], 'rank_score_exp');
            $table->index(['country_acronym', 'rank_score_exp'], 'country_acronym_exp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        static::applyAll(function (Blueprint $table): void {
            $table->dropIndex('rank_score_exp');
            $table->dropIndex('country_acronym_exp');
            $table->dropColumn('rank_score_exp');
            $table->dropColumn('rank_score_index_exp');
        });
    }
};
