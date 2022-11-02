<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOsuUserPerformanceRankHighest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('osu_user_performance_rank_highest', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->unsignedInteger('user_id');
            $table->tinyInteger('mode');
            $table->integer('rank')->default(0);
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['user_id', 'mode']);
        });
        DB::statement('
            ALTER TABLE `osu_user_performance_rank_highest`
            ROW_FORMAT=DYNAMIC
            PARTITION BY RANGE (`mode`) (
                PARTITION p0 VALUES LESS THAN (1),
                PARTITION p1 VALUES LESS THAN (2),
                PARTITION p2 VALUES LESS THAN (3),
                PARTITION p3 VALUES LESS THAN (4)
            );
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osu_user_performance_rank_highest');
    }
}
