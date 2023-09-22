<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('phpbb_sessions')) {
            return;
        }

        Schema::create('phpbb_sessions', function (Blueprint $table) {
            $table->collation = 'utf8_bin';
            $table->charset = 'utf8';

            $table->string('session_id', 32)->default('');
            $table->mediumInteger('session_user_id')->unsigned()->default(0);
            $table->integer('session_last_visit')->unsigned()->default(0);
            $table->integer('session_start')->unsigned()->default(0);
            $table->integer('session_time')->unsigned()->default(0);
            $table->string('session_ip', 40)->default('');
            $table->string('session_forwarded_for')->default('');
            $table->string('session_page')->default('');
            $table->boolean('session_viewonline')->unsigned()->default(1);
            $table->boolean('session_autologin')->unsigned()->default(0);
            $table->boolean('session_admin')->unsigned()->default(0);
            $table->boolean('verified')->default(0);

            $table->primary('session_id');
            $table->index(['session_time', 'session_page'], 'time_page');
            $table->index(['session_autologin', 'session_time'], 'autologin_time_purge');
            $table->index(['session_user_id', 'session_time'], 'session_user_id_time');
        });

        DB::statement('ALTER TABLE phpbb_sessions ROW_FORMAT=DYNAMIC');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('phpbb_sessions');
    }
};
