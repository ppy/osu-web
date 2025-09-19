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
        Schema::table('solo_scores', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->index(['user_id', 'ruleset_id', DB::raw('id DESC')], 'user_ruleset_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solo_scores', function (Blueprint $table) {
            $table->index('user_id');
            $table->dropIndex('user_ruleset_id_index');
        });
    }
};
