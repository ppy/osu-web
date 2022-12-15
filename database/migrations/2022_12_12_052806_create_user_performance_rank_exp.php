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
        Schema::create('osu_user_performance_rank_exp', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->boolean('mode');
            for ($i = 0; $i < 90; $i++) {
                $table->integer("r{$i}")->default(0);
            }
            $table->primary(['user_id', 'mode']);
        });

        $partitions = 'PARTITION p0 VALUES LESS THAN (1),';
        $partitions .= 'PARTITION p1 VALUES LESS THAN (2),';
        $partitions .= 'PARTITION p2 VALUES LESS THAN (3),';
        $partitions .= 'PARTITION p3 VALUES LESS THAN (4)';
        DB::statement("ALTER TABLE `osu_user_performance_rank_exp` PARTITION BY RANGE (mode) ({$partitions});");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('osu_user_performance_rank_exp');
    }
};
