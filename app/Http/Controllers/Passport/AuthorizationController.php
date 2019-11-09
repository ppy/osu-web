<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers\Passport;

use Illuminate\Http\Request;
use Laravel\Passport\Bridge\Scope;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;
use Laravel\Passport\TokenRepository;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Extension of Laravel\Passport\Http\Controllers\AuthorizationController
 * to add support for scope normalization when requesting token scopes.
 */
class AuthorizationController extends PassportAuthorizationController
{
    /**
     * Authorize a client to access the user's account.
     * This overrides the default implementation to normalize scope requests
     * and sort the scopes by key order.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $psrRequest
     * @param  \Illuminate\Http\Request $request
     * @param  \Laravel\Passport\ClientRepository $clients
     * @param  \Laravel\Passport\TokenRepository $tokens
     * @return \Illuminate\Http\Response
     */
    public function authorize(ServerRequestInterface $psrRequest,
                              Request $request,
                              ClientRepository $clients,
                              TokenRepository $tokens)
    {
        view()->share('currentSection', 'user');

        if (!auth()->check()) {
            $cancelUrl = request('redirect_uri');

            if (present($cancelUrl)) {
                // Breaks when url contains hash ("#").
                $separator = strpos($cancelUrl, '?') === false ? '?' : '&';
                $cancelUrl .= "{$separator}error=access_denied";
            } else {
                $cancelUrl = route('home');
            }

            return view('passport::login', [
                'cancelUrl' => $cancelUrl,
                'currentAction' => 'oauth_login',
            ]);
        }

        view()->share('currentAction', 'oauth_request');

        return parent::authorize($this->normalizeRequestScopes($psrRequest), $request, $clients, $tokens);
    }

    /**
     * Normalizes the authorization request's scopes.
     *
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    private function normalizeRequestScopes(ServerRequestInterface $request) : ServerRequestInterface
    {
        $params = $request->getQueryParams();
        $scopes = $this->normalizeScopes(
            explode(' ', $params['scope'] ?? null)
        );
        $params['scope'] = implode(' ', $scopes);

        return $request->withQueryParams($params);
    }

    /**
     * Normalizes and sorts scopes.
     *
     * @param array $scopes
     * @return array
     */
    private function normalizeScopes(array $scopes) : array
    {
        if (!in_array('identify', $scopes, true)) {
            $scopes[] = 'identify';
        }

        sort($scopes);

        return $scopes;
    }
}
