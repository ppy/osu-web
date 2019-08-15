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

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;

class OwnClientsController extends Controller
{
    protected $section = 'user';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function destroy($clientId)
    {
        $client = auth()->user()->oauthClients()->findOrFail($clientId);
        $client->getConnection()->transaction(function () use ($client) {
            $now = now('UTC');
            // TODO: also revoke refresh tokens.
            $client->tokens()->update(['revoked' => true, 'updated_at' => $now]);
            // TODO: set timestamp to false on authcodes
            // $client->authCodes()->update(['revoked' => true]);
            $client->update(['revoked' => true, 'updated_at' => $now]);
        });

        return response(null, 204);
    }
}
