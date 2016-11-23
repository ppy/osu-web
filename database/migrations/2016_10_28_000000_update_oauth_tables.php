<?php

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
        (new CreateOauthRefreshTokensTable)->down();
        (new CreateOauthAccessTokenScopesTable)->down();
        (new CreateOauthAccessTokensTable)->down();
        (new CreateOauthAuthCodeScopesTable)->down();
        (new CreateOauthAuthCodesTable)->down();
        (new CreateOauthSessionScopesTable)->down();
        (new CreateOauthSessionsTable)->down();
        (new CreateOauthClientGrantsTable)->down();
        (new CreateOauthClientScopesTable)->down();
        (new CreateOauthClientEndpointsTable)->down();
        (new CreateOauthClientsTable)->down();
        (new CreateOauthGrantScopesTable)->down();
        (new CreateOauthGrantsTable)->down();
        (new CreateOauthScopesTable)->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        (new CreateOauthScopesTable)->up();
        (new CreateOauthGrantsTable)->up();
        (new CreateOauthGrantScopesTable)->up();
        (new CreateOauthClientsTable)->up();
        (new CreateOauthClientEndpointsTable)->up();
        (new CreateOauthClientScopesTable)->up();
        (new CreateOauthClientGrantsTable)->up();
        (new CreateOauthSessionsTable)->up();
        (new CreateOauthSessionScopesTable)->up();
        (new CreateOauthAuthCodesTable)->up();
        (new CreateOauthAuthCodeScopesTable)->up();
        (new CreateOauthAccessTokensTable)->up();
        (new CreateOauthAccessTokenScopesTable)->up();
        (new CreateOauthRefreshTokensTable)->up();
    }
}
