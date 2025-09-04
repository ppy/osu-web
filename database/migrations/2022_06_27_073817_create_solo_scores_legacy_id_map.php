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
        Schema::create('solo_scores_legacy_id_map', function (Blueprint $table) {
            $table->unsignedSmallInteger('ruleset_id');
            $table->unsignedInteger('old_score_id');
            $table->unsignedBigInteger('score_id');
            $table->primary(['ruleset_id', 'old_score_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solo_scores_legacy_id_map');
    }
};
