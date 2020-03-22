<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreProcessQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_process_queue', function (Blueprint $table) {
            $table->unsignedInteger('queue_id', true);
            $table->unsignedBigInteger('score_id');
            $table->unsignedTinyInteger('mode');
            $table->timestampTz('start_time')->useCurrent();
            $table->timestampTz('update_time')->nullable()->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean('status')->default(0);

            $table->index(['mode', 'status', 'score_id'], 'lookup');
            $table->index(['status'], 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('score_process_queue');
    }
}
