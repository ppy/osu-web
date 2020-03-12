<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;

class UpdateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('osu_achievements', 'enabled')) {
            Schema::table('osu_achievements', function ($table) {
                $table->boolean('enabled')->default(true);
            });
        }

        if (!Schema::hasColumn('osu_achievements', 'mode')) {
            Schema::table('osu_achievements', function ($table) {
                $table->tinyInteger('mode')->nullable();
            });
        }

        Schema::table('osu_achievements', function ($table) {
            $table->string('image', 50)->nullable()->change();
        });

        // DBAL, which is used to execute `change()`, doesn't support `mediumInteger`.
        DB::statement('ALTER TABLE osu_achievements MODIFY achievement_id MEDIUMINT UNSIGNED NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('osu_achievements', function ($table) {
            $table->dropColumn('enabled');
            $table->dropColumn('mode');
            $table->string('image', 50)->change();
        });

        // `mediumIncrements` requires unsupported `mediumInteger`.
        DB::statement('ALTER TABLE osu_achievements MODIFY achievement_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }
}
