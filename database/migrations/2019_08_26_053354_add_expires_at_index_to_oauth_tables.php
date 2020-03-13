<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiresAtIndexToOauthTables extends Migration
{
    const TABLES = ['oauth_auth_codes', 'oauth_access_tokens', 'oauth_refresh_tokens'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (static::TABLES as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->index(['expires_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (static::TABLES as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropIndex(['expires_at']);
            });
        }
    }
}
