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

namespace App\Http\Controllers;

use Laravel\Passport\Passport;
use Laravel\Passport\Bridge\Scope;
use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;

class AuthorizationController extends PassportAuthorizationController
{
    /**
     * Transform the authorization requests's scopes into Scope instances.
     *
     * @param  \League\OAuth2\Server\RequestTypes\AuthorizationRequest  $authRequest
     * @return array
     */
    protected function parseScopes($authRequest)
    {
        $scopes = $authRequest->getScopes();
        if (empty($scopes)) {
            $scopes = [new Scope('identify')];
        }

        return Passport::scopesFor(
            collect($scopes)->map(function ($scope) {
                return $scope->getIdentifier();
            })->all()
        );
    }
}
