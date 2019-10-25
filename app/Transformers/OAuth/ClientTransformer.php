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
