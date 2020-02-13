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
use App\Models\OAuth\Client;

class ClientsController extends Controller
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
        $client->revoke();

        return response(null, 204);
    }

    public function index()
    {
        return json_collection(auth()->user()->oauthClients()->where('revoked', false)->get(), 'OAuth\Client', ['redirect', 'secret']);
    }

    public function store()
    {
        // from ClientRepository::create but with custom Client.
        $client = (new Client)->forceFill([
            'user_id' => auth()->user()->getKey(),
            'name' => request('name'),
            'secret' => str_random(40),
            'redirect' => request('redirect'),
            'personal_access_client' => false,
            'password_client' => false,
            'revoked' => false,
        ]);

        if (!$client->save()) {
            return response([
                'form_error' => $client->validationErrors()->all(),
            ], 422);
        }

        return json_item($client, 'OAuth\Client', ['redirect', 'secret']);
    }

    public function update($clientId)
    {
        $client = auth()->user()->oauthClients()->findOrFail($clientId);

        $params = request(['redirect']);

        // client doesn't inherit from our base model.
        if (!$client->fill($params)->save()) {
            return response([
                'form_error' => $client->validationErrors()->all(),
            ], 422);
        }

        return json_item($client, 'OAuth\Client', ['redirect', 'secret']);
    }
}
