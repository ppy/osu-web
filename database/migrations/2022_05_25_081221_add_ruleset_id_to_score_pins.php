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
     *
     * @return void
     */
    public function up()
    {
        Schema::table('score_pins', function (Blueprint $table) {
            $table->smallInteger('ruleset_id')->unsigned()->after('score_id');
        });

        static $rulesets = [
            'osu' => 0,
            'taiko' => 1,
            'fruits' => 2,
            'mania' => 3,
        ];
        foreach ($rulesets as $ruleset => $rulesetId) {
            DB::table('score_pins')
                ->where('score_type', "score_best_{$ruleset}")
                ->update(['ruleset_id' => $rulesetId]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('score_pins', function (Blueprint $table) {
            $table->dropColumn('ruleset_id');
        });
    }
};
