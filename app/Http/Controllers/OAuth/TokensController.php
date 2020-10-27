<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthApi;

/**
 * @group OAuth Tokens
 */
class TokensController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * Revoke current token
     *
     * Revokes currently authenticated token.
     *
     * @authenticated
     *
     * @response 204
     */
    public function destroyCurrent()
    {
        $token = request()->get(AuthApi::REQUEST_OAUTH_TOKEN_KEY);

        if ($token !== null) {
            $token->revokeRecursive();
        }

        return response(null, 204);
    }
}
