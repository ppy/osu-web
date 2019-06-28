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

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;
use Laravel\Passport\Token;

class AuthorizedClientsController extends Controller
{
    protected $section = 'user';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function index()
    {
        // Get client list.
        $tokensQuery = Token::where('user_id', auth()->id())->where('revoked', false);

        $clients = Client::whereIn('id', (clone $tokensQuery)->select('client_id'))
            ->where('personal_access_client', false)
            ->where('password_client', false)
            ->where('revoked', false)
            ->get();

        // Aggregate permissions granted to client via tokens.
        $tokenScopes = $tokensQuery->whereIn('client_id', $clients->pluck('id'))->select('client_id', 'scopes')->get();
        $clientScopes = $tokenScopes->mapToGroups(function ($item) {
            return [$item->client_id => $item->scopes];
        });

        foreach ($clients as $client) {
            $client->scopes = array_sort(array_unique(array_flatten($clientScopes)));
        }

        $authorizedClients = json_collection($clients, 'OAuth\Client');

        return view('oauth.authorized-clients.index', compact('authorizedClients'));
    }

    public function destroy($clientId)
    {
        $client = Client::findOrFail($clientId);
        if ($client->firstParty()) {
            throw new InvariantException('First party tokens cannot be revoked through this method.');
        }

        auth()
            ->user()
            ->tokens()
            ->where('client_id', $clientId)
            ->update([
                'revoked' => true,
                'updated_at' => now(),
            ]);

        return response(null, 204);
    }
}
