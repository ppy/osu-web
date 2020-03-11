<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddWikiAndStoreLinkToTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function ($table) {
            $table->unsignedInteger('tournament_banner_product_id')->nullable()->default(null);
            $table->string('info_url')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function ($table) {
            $table->dropColumn('tournament_banner_product_id');
            $table->dropColumn('info_url');
        });
    }
}
