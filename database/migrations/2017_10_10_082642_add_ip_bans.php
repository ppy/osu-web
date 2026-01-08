<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIpBans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('osu_ip_bans')) {
            return;
        }

        Schema::create('osu_ip_bans', function ($table) {
            $table->string('ip', 40)->primary()->default('');
            $table->unsignedMediumInteger('user_id')->nullable();
            $table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('length')->default(72 * 3600);
            $table->boolean('active')->default(true);

            $table->index('user_id', 'user_id');
            $table->index(['active', 'timestamp'], 'active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('osu_ip_bans');
    }
}
