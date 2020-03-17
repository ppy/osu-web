<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class UniqueUserCustomizationUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE user_profile_customizations MODIFY user_id MEDIUMINT UNSIGNED NULL');

        Schema::table('user_profile_customizations', function ($table) {
            $table->foreign('user_id')->references('user_id')->on('phpbb_users');
            $table->unique('user_id');
            $table->dropIndex('user_profile_customizations_user_id_index');
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
            $table->index('user_id');
            $table->dropUnique('user_profile_customizations_user_id_unique');
            $table->dropForeign('user_profile_customizations_user_id_foreign');
        });

        DB::statement('ALTER TABLE user_profile_customizations MODIFY user_id INT NOT NULL');
    }
}
