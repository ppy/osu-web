<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
            $cancelUrl = presence(request('redirect_uri'));

            if ($cancelUrl !== null) {
                // Breaks when url contains hash ("#").
                $separator = strpos($cancelUrl, '?') === false ? '?' : '&';
                $cancelUrl .= "{$separator}error=access_denied";
            }

            return ext_view('sessions.create', [
                'cancelUrl' => $cancelUrl,
                'currentAction' => 'oauth_login',
            ]);
        }

        view()->share('currentAction', 'oauth_request');

        return parent::authorize($this->normalizeRequestScopes($psrRequest), $request, $clients, $tokens);
    }

    public function getSection()
    {
        return 'user';
    }

    /**
     * Normalizes the authorization request's scopes.
     *
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    private function normalizeRequestScopes(ServerRequestInterface $request): ServerRequestInterface
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
    private function normalizeScopes(array $scopes): array
    {
        if (!in_array('identify', $scopes, true)) {
            $scopes[] = 'identify';
        }

        sort($scopes);

        return $scopes;
    }
}
