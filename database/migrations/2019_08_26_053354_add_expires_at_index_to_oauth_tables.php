<?php

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
