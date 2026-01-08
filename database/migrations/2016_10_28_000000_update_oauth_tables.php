<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

class UpdateOauthTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        migration('2016_03_18_170013_create_oauth_refresh_tokens_table')->down();
        migration('2016_03_18_170012_create_oauth_access_token_scopes_table')->down();
        migration('2016_03_18_170011_create_oauth_access_tokens_table')->down();
        migration('2016_03_18_170010_create_oauth_auth_code_scopes_table')->down();
        migration('2016_03_18_170009_create_oauth_auth_codes_table')->down();
        migration('2016_03_18_170008_create_oauth_session_scopes_table')->down();
        migration('2016_03_18_170007_create_oauth_sessions_table')->down();
        migration('2016_03_18_170006_create_oauth_client_grants_table')->down();
        migration('2016_03_18_170005_create_oauth_client_scopes_table')->down();
        migration('2016_03_18_170004_create_oauth_client_endpoints_table')->down();
        migration('2016_03_18_170003_create_oauth_clients_table')->down();
        migration('2016_03_18_170002_create_oauth_grant_scopes_table')->down();
        migration('2016_03_18_170001_create_oauth_grants_table')->down();
        migration('2016_03_18_170000_create_oauth_scopes_table')->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        migration('2016_03_18_170000_create_oauth_scopes_table')->up();
        migration('2016_03_18_170001_create_oauth_grants_table')->up();
        migration('2016_03_18_170002_create_oauth_grant_scopes_table')->up();
        migration('2016_03_18_170003_create_oauth_clients_table')->up();
        migration('2016_03_18_170004_create_oauth_client_endpoints_table')->up();
        migration('2016_03_18_170005_create_oauth_client_scopes_table')->up();
        migration('2016_03_18_170006_create_oauth_client_grants_table')->up();
        migration('2016_03_18_170007_create_oauth_sessions_table')->up();
        migration('2016_03_18_170008_create_oauth_session_scopes_table')->up();
        migration('2016_03_18_170009_create_oauth_auth_codes_table')->up();
        migration('2016_03_18_170010_create_oauth_auth_code_scopes_table')->up();
        migration('2016_03_18_170011_create_oauth_access_tokens_table')->up();
        migration('2016_03_18_170012_create_oauth_access_token_scopes_table')->up();
        migration('2016_03_18_170013_create_oauth_refresh_tokens_table')->up();
    }
}
