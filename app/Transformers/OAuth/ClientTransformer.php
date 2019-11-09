<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers\OAuth;

use App\Models\OAuth\Client;
use App\Transformers\UserCompactTransformer;
use League\Fractal;

class ClientTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'redirect',
        'secret',
        'user',
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
        return $this->item($client->user, new UserCompactTransformer);
    }

    public function includeRedirect(Client $client)
    {
        if (!static::isOwnClient($client)) {
            return;
        }

        return $this->primitive($client->redirect);
    }

    public function includeSecret(Client $client)
    {
        if (!static::isOwnClient($client)) {
            return;
        }

        return $this->primitive($client->secret);
    }

    private static function isOwnClient(Client $client)
    {
        return auth()->check() && auth()->user()->getKey() === $client->user_id;
    }
}
