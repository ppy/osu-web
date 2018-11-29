<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

use Laravel\Passport\Passport;
use Laravel\Passport\Bridge\Scope;
use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;

/**
 * Extension of Laravel\Passport\Http\Controllers\AuthorizationController
 * to add support for scope normalization when requesting token scopes.
 */
class AuthorizationController extends PassportAuthorizationController
{
    /**
     * Transform the authorization requests's scopes into Scope instances.
     * This overrides the default implementation to normalize scope requests.
     *
     * @param  \League\OAuth2\Server\RequestTypes\AuthorizationRequest  $authRequest
     * @return array
     */
    protected function parseScopes($authRequest)
    {
        $scopes = collect($authRequest->getScopes())->map(function ($scope) {
            return $scope->getIdentifier();
        });

        if (!$scopes->containsStrict('identify')) {
            $scopes->push('identify');
        }

        return Passport::scopesFor($scopes->all());
    }
}
