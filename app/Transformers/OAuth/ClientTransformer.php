<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers\OAuth;

use App\Models\OAuth\Client;
use App\Transformers\TransformerAbstract;
use App\Transformers\UserCompactTransformer;

class ClientTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'redirect',
        'secret',
        'user',
    ];

    protected $permissions = [
        'redirect' => 'IsOwnClient',
        'secret' => 'IsOwnClient',
    ];

    public function transform(Client $client)
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'password_client' => $client->password_client,
            'personal_access_client' => $client->personal_access_client,
            'scopes' => $client->scopes,
            'user_id' => $client->user_id,
        ];
    }

    public function includeUser(Client $client)
    {
        return $this->item($client->user, new UserCompactTransformer());
    }

    public function includeRedirect(Client $client)
    {
        return $this->primitive($client->redirect);
    }

    public function includeSecret(Client $client)
    {
        return $this->primitive($client->secret);
    }
}
