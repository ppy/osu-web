<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Zend\Diactoros\ResponseFactory;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\StreamFactory;
use Zend\Diactoros\UploadedFileFactory;

class AuthApi
{
    const REQUEST_OAUTH_TOKEN_KEY = 'oauth_token';

    protected $server;
    protected $repository;

    public function __construct(ResourceServer $server, TokenRepository $repository)
    {
        $this->server = $server;
        $this->repository = $repository;
    }

    public function handle($request, Closure $next)
    {
        auth()->shouldUse('api');

        // FIXME: should assign token even if not required.
        if (!RequireScopes::noTokenRequired($request)) {
            $psr = $this->validateRequest($request);

            $token = $this->validTokenFromRequest($psr);

            $request->attributes->set(static::REQUEST_OAUTH_TOKEN_KEY, $token);
        }

        optional(auth()->user())->markSessionVerified();

        return $next($request);
    }

    private function validateRequest($request)
    {
        $psr = (new PsrHttpFactory(
            new ServerRequestFactory,
            new StreamFactory,
            new UploadedFileFactory,
            new ResponseFactory
        ))->createRequest($request);

        try {
            return $this->server->validateAuthenticatedRequest($psr);
        } catch (OAuthServerException $e) {
            throw new AuthenticationException;
        }
    }

    private function validTokenFromRequest($psr)
    {
        $token = $this->repository->find($psr->getAttribute('oauth_access_token_id'));

        if ($token === null
            || $token->revoked
            || optional($token->user)->getKey() !== auth()->id()
        ) {
            throw new AuthenticationException;
        }

        return $token;
    }
}
