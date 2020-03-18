<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIndexToKudosuHistoriesKudosuable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('osu_kudos_exchange', function ($table) {
            $table->index(['kudosuable_type', 'kudosuable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_kudos_exchange', function ($table) {
            $table->dropIndex(['kudosuable_type', 'kudosuable_id']);
        });
    }
}
