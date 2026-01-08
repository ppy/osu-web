<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBssProcessQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bss_process_queue', function (Blueprint $table) {
            $table->increments('queue_id');

            $table->unsignedInteger('beatmapset_id');
            $table->timestamp('start_time')->useCurrent();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('update_time')->nullable()->default(null)->useCurrentOnUpdate();

            $table->index('status', 'status');
            $table->index('beatmapset_id', 'beatmapset_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bss_process_queue');
    }
}
