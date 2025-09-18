<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpgradeLegacyScoreidsToBigint extends Migration
{
    const MODE_SUFFIXES = ['', '_fruits', '_mania', '_taiko'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (static::MODE_SUFFIXES as $modeSuffix) {
            Schema::table("osu_leaders{$modeSuffix}", function (Blueprint $table) {
                $table->bigInteger('score_id')->unsigned()->nullable(false)->change();
            });

            Schema::table("osu_replays{$modeSuffix}", function (Blueprint $table) {
                $table->bigInteger('score_id')->unsigned()->default(0)->change();
            });


            // Laravel bigIncrements() is always a primary key, which causes issues with the existing primary key.

            DB::statement("ALTER TABLE `osu_scores{$modeSuffix}_high` MODIFY `score_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");

            DB::statement("ALTER TABLE `osu_scores{$modeSuffix}` MODIFY `score_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
        }

        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->bigInteger('score_id')->unsigned()->default(0)->change();
        });

        Schema::table('solo_scores_legacy_id_map', function (Blueprint $table) {
            $table->bigInteger('old_score_id')->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (static::MODE_SUFFIXES as $modeSuffix) {
            Schema::table("osu_leaders{$modeSuffix}", function (Blueprint $table) {
                $table->integer('score_id')->unsigned()->nullable()->default(null)->change();
            });

            Schema::table("osu_replays{$modeSuffix}", function (Blueprint $table) {
                $table->integer('score_id')->unsigned()->default(0)->change();
            });

            // Workaround for same issue with increments() as above.

            DB::statement("ALTER TABLE `osu_scores{$modeSuffix}_high` MODIFY `score_id` INT UNSIGNED NOT NULL AUTO_INCREMENT");
        }

        // osu_scores remains as BIGINT

        DB::statement('ALTER TABLE `osu_scores_fruits` MODIFY `score_id` INT UNSIGNED NOT NULL AUTO_INCREMENT');

        DB::statement('ALTER TABLE `osu_scores_taiko` MODIFY `score_id` INT UNSIGNED NOT NULL AUTO_INCREMENT');

        DB::statement('ALTER TABLE `osu_scores_mania` MODIFY `score_id` INT UNSIGNED NOT NULL AUTO_INCREMENT');

        Schema::table('osu_user_reports', function (Blueprint $table) {
            $table->integer('score_id')->unsigned()->default(0)->change();
        });

        Schema::table('solo_scores_legacy_id_map', function (Blueprint $table) {
            $table->integer('old_score_id')->unsigned()->change();
        });
    }
}
