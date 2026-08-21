<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use App\Libraries\OAuth\EncodeToken;
use App\Libraries\SessionVerification;
use App\Models\OAuth\Token;
use Closure;
use Illuminate\Auth\AuthenticationException;

class AuthApi
{
    const REQUEST_OAUTH_TOKEN_KEY = 'oauth_token';

    public function handle($request, Closure $next)
    {
        // FIXME:
        // default session guard is used. This really works by coincidence with cookies disabled
        // since session user resolution will fail, but it'll still keep repeatedly attempting to resolve it.

        $bearerToken = $request->bearerToken();

        if ($bearerToken !== null) {
            $token = $this->validTokenFromRequest($bearerToken);
            $request->attributes->set(static::REQUEST_OAUTH_TOKEN_KEY, $token);
        } else {
            if (!RequireScopes::noTokenRequired($request)) {
                throw new AuthenticationException();
            }
        }

        return $next($request);
    }

    private function validTokenFromRequest(string $bearerToken): Token
    {
        $tokenId = EncodeToken::decodeAccessToken($bearerToken);
        $token = Token::findActiveOrFail($tokenId);

        // increment hit count for about every 10 hits
        if (rand(0, 9) === 0) {
            $token->incrementInstance('hit_count', 10);
        }

        $user = $token->getResourceOwner();

        if ($user !== null) {
            \Auth::setUser($user);
            $user->withAccessToken($token);

            if ($token->isVerified()) {
                $user->markSessionVerified();
            } else {
                if ($token->getVerificationMethod() === null) {
                    $verificationState = new SessionVerification\State($token, $user);
                    if ($verificationState->getMethod() === 'mail') {
                        $verificationState->issueMail(true);
                    }
                }
            }
        }

        return $token;
    }
}
