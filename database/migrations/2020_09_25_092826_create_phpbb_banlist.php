<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhpbbBanlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('phpbb_banlist')) {
            return;
        }

        Schema::create('phpbb_banlist', function (Blueprint $table) {
            $table->mediumIncrements('ban_id');
            $table->unsignedMediumInteger('ban_userid')->default(0);
            $table->string('ban_ip', 40)->default('');
            $table->string('ban_email', 100)->default('');
            $table->unsignedInteger('ban_start')->default(0);
            $table->unsignedInteger('ban_end')->default(0);
            $table->unsignedTinyInteger('ban_exclude')->default(0);
            $table->string('ban_reason', 255)->default('');
            $table->string('ban_give_reason', 255)->default('');

            $table->index(['ban_end'], 'ban_end');
            $table->index(['ban_userid', 'ban_exclude'], 'ban_user');
            $table->index(['ban_email', 'ban_exclude'], 'ban_email');
            $table->index(['ban_ip', 'ban_exclude'], 'ban_ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phpbb_banlist');
    }
}
