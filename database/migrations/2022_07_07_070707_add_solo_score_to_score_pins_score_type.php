<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE score_pins CHANGE score_type score_type ENUM(
            'score_best_fruits',
            'score_best_mania',
            'score_best_osu',
            'score_best_taiko',
            'solo_score'
        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE score_pins CHANGE score_type score_type ENUM(
            'score_best_fruits',
            'score_best_mania',
            'score_best_osu',
            'score_best_taiko'
        )");
    }
};
