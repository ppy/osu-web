<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;

/**
 * @group OAuth Tokens
 */
class TokensController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:any', ['only' => ['destroyCurrent']]);
    }

    /**
     * Revoke current token
     *
     * Revokes currently authenticated token.
     *
     * @response 204
     */
    public function destroyCurrent()
    {
        $token = oauth_token();

        if ($token !== null) {
            $token->revokeRecursive();
        }

        return response(null, 204);
    }
}
