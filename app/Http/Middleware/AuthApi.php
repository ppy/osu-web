<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\ClientRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class AuthApi
{
    const REQUEST_OAUTH_TOKEN_KEY = 'oauth_token';

    protected $clients;
    protected $server;

    public function __construct(ResourceServer $server, ClientRepository $clients)
    {
        $this->clients = $clients;
        $this->server = $server;
    }

    public function handle($request, Closure $next)
    {
        // FIXME:
        // default session guard is used. This really works by coincidence with cookies disabled
        // since session user resolution will fail, but it'll still keep repeatedly attempting to resolve it.

        if ($request->bearerToken() !== null) {
            $psr = $this->validateRequest($request);
            $token = $this->validTokenFromRequest($psr);
            $request->attributes->set(static::REQUEST_OAUTH_TOKEN_KEY, $token);
        } else {
            if (!RequireScopes::noTokenRequired($request)) {
                throw new AuthenticationException();
            }
        }

        return $next($request);
    }

    private function validateRequest($request)
    {
        $psr17Factory = new Psr17Factory();

        $psr = (new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
        ))->createRequest($request);

        try {
            return $this->server->validateAuthenticatedRequest($psr);
        } catch (OAuthServerException $e) {
            throw new AuthenticationException();
        }
    }

    private function validTokenFromRequest($psr)
    {
        $psrClientId = $psr->getAttribute('oauth_client_id');
        $psrUserId = get_int($psr->getAttribute('oauth_user_id'));
        $psrTokenId = $psr->getAttribute('oauth_access_token_id');

        $client = $this->clients->findActive($psrClientId);
        if ($client === null) {
            throw new AuthenticationException('invalid client');
        }

        $token = $client->tokens()->validAt(now())->find($psrTokenId);
        if ($token === null) {
            throw new AuthenticationException('invalid token');
        }

        $token->validate();

        $user = $token->getResourceOwner();

        if ($token->isClientCredentials() && $psrUserId !== null) {
            throw new AuthenticationException();
        }

        if (!$token->isClientCredentials() && $user->getKey() !== $psrUserId) {
            throw new AuthenticationException();
        }

        if ($user !== null) {
            auth()->setUser($user);
            $user->withAccessToken($token);
            $user->markSessionVerified();
        }

        return $token;
    }
}
