<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
