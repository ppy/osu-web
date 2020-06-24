<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\Http\Middleware\CheckCredentials;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Zend\Diactoros\ResponseFactory;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\StreamFactory;
use Zend\Diactoros\UploadedFileFactory;

class RequireScopes extends CheckCredentials
{
    const REQUEST_OAUTH_TOKEN_KEY = 'oauthToken';
    const REQUEST_VALIDATED_PSR_KEY = 'oauthPsrRequest';

    /**
     * {@inheritdoc}
     */
    public function handle($request, Closure $next, ...$scopes)
    {
        if (!is_api_request() || AuthApi::skipAuth($request)) {
            return $next($request);
        }

        $psr = $this->validateRequest($request);

        $this->validate($psr, $scopes);

        return $next($request);

        // TODO: also stop validating request every time.

        // return parent::handle($request, $next, ...$scopes);
    }

    protected function validateRequest($request)
    {
        if (!$request->attributes->has(static::REQUEST_VALIDATED_PSR_KEY)) {
            $psr = (new PsrHttpFactory(
                new ServerRequestFactory,
                new StreamFactory,
                new UploadedFileFactory,
                new ResponseFactory
            ))->createRequest($request);

            try {
                \Log::debug('validateRequest');
                $psr = $this->server->validateAuthenticatedRequest($psr);
                $request->attributes->set(static::REQUEST_VALIDATED_PSR_KEY, $psr);
            } catch (OAuthServerException $e) {
                throw new AuthenticationException;
            }
        }

        return $request->attributes->get(static::REQUEST_VALIDATED_PSR_KEY);
    }

    /**
     * {@inheritdoc}
     */
    protected function validate($psr, $scopes)
    {
        $request = request();
        if (!$request->attributes->has(static::REQUEST_OAUTH_TOKEN_KEY)) {
            $request->attributes->set(
                static::REQUEST_OAUTH_TOKEN_KEY,
                $this->repository->find($psr->getAttribute('oauth_access_token_id'))
            );
        }

        $token = $request->attributes->get(static::REQUEST_OAUTH_TOKEN_KEY);

        $this->validateCredentials($token);

        $this->validateScopes($token, $scopes);

        $user = $token->user;
        \Log::debug('token user_id: '.optional($user)->getKey().' auth_id: '.auth()->id());
        if (optional($user)->getKey() !== auth()->id()) {
            throw new \Exception('something gone horribly wrong');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validateCredentials($token)
    {
        if ($token === null || $token->revoked) {
            throw new AuthenticationException();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validateScopes($token, $scopes)
    {
        if (empty($token->scopes)) {
            throw new MissingScopeException([], 'Tokens without scopes are not valid.');
        }

        if (!$this->requestHasScopedMiddleware(request())) {
            // use a non-existent scope; only '*' should pass.
            if (!$token->can('invalid')) {
                throw new MissingScopeException();
            }
        } else {
            foreach ($scopes as $scope) {
                if (!$token->can($scope)) {
                    throw new MissingScopeException([$scope], 'A required scope is missing.');
                }
            }
        }
    }

    /**
     * Returns if the request contains this middleware with scope parameter checks.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function requestHasScopedMiddleware(Request $request): bool
    {
        $value = $request->attributes->get('requestHasScopedMiddleware');
        if ($value === null) {
            $value = $this->containsScoped($request);
            $request->attributes->set('requestHasScopedMiddleware', $value);
        }

        return $value;
    }

    private function containsScoped(Request $request)
    {
        foreach ($request->route()->gatherMiddleware() as $middleware) {
            if (is_string($middleware) && starts_with($middleware, 'require-scopes:')) {
                return true;
            }
        }

        return false;
    }
}
