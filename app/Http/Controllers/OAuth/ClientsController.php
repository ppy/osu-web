<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\OAuth\Client;
use App\Transformers\OAuth\ClientTransformer;

class ClientsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('verify-user');
    }

    public function destroy($clientId)
    {
        $client = \Auth::user()->clients()->findOrFail($clientId);
        $client->revoke();

        return response()->noContent();
    }

    public function index()
    {
        return json_collection(\Auth::user()->clients()->where('revoked', false)->get(), new ClientTransformer(), ['redirect', 'secret']);
    }

    public function resetSecret($clientId)
    {
        $client = \Auth::user()->clients()->findOrFail($clientId);

        if (!$client->resetSecret()) {
            return error_popup(osu_trans('oauth.client.reset_failed'));
        }

        return json_item($client, new ClientTransformer(), ['redirect', 'secret']);
    }

    public function store()
    {
        $params = get_params(request()->all(), null, [
            'name',
            'redirect',
        ]);

        // from ClientRepository::create but with custom Client.
        $client = (new Client())->forceFill([
            'grant_types' => ['authorization_code', 'client_credentials', 'refresh_token'],
            'name' => $params['name'] ?? null,
            'redirect' => $params['redirect'] ?? '',
            'revoked' => false,
            'secret' => str_random(40),
            'user_id' => \Auth::user()->getKey(),
        ]);

        if (!$client->save()) {
            return response([
                'form_error' => $client->validationErrors()->all(),
            ], 422);
        }

        return json_item($client, new ClientTransformer(), ['redirect', 'secret']);
    }

    public function update($clientId)
    {
        $client = \Auth::user()->clients()->findOrFail($clientId);

        $params = request(['redirect']);

        // client doesn't inherit from our base model.
        if (!$client->fill($params)->save()) {
            return response([
                'form_error' => $client->validationErrors()->all(),
            ], 422);
        }

        return json_item($client, new ClientTransformer(), ['redirect', 'secret']);
    }
}
