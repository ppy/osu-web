<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
use Illuminate\Database\Migrations\Migration;

class AddExtrasOrderOnUserProfileCustomization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile_customizations', function ($table) {
            $table->string('extras_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile_customizations', function ($table) {
            $table->dropColumn('extras_order');
        });
    }
}
