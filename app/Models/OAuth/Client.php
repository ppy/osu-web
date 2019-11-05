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

namespace App\Models\OAuth;

use App\Exceptions\InvariantException;
use App\Models\User;
use App\Traits\Validatable;
use DB;
use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    use Validatable;

    public static function forUser(User $user)
    {
        // Get clients matching non-revoked tokens. Expired tokens should be included.
        $tokensQuery = Token::where('user_id', $user->getKey())->where('revoked', false);

        $clients = static::whereIn('id', (clone $tokensQuery)->select('client_id'))
            ->thirdParty()
            ->where('revoked', false)
            ->with('user')
            ->get();

        // Aggregate permissions granted to client via tokens.
        $tokenScopes = $tokensQuery->whereIn('client_id', $clients->pluck('id'))->select('client_id', 'scopes')->get();
        $clientScopes = $tokenScopes->mapToGroups(function ($item) {
            return [$item->client_id => $item->scopes];
        });

        foreach ($clients as $client) {
            $client->scopes = array_values(array_sort(array_unique(array_flatten($clientScopes[$client->id]))));
        }

        return $clients;
    }

    public function refreshTokens()
    {
        return $this->hasManyThrough(
            RefreshToken::class,
            Token::class,
            'client_id',
            'access_token_id'
        );
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if (!$this->exists) {
            $max = config('osu.oauth.max_user_clients');
            if ($this->user->oauthClients()->thirdParty()->where('revoked', false)->count() >= $max) {
                $this->validationErrors()->add('user.oauthClients.count', '.too_many');
            }
        }

        if (mb_strlen(trim($this->name)) === 0) {
            $this->validationErrors()->add('name', 'required');
        }

        if (mb_strlen(trim($this->redirect)) === 0) {
            $this->validationErrors()->add('redirect', 'required');
        }

        // TODO: this url validation is not very good.
        if (!filter_var(trim($this->redirect), FILTER_VALIDATE_URL)) {
            $this->validationErrors()->add('redirect', '.url');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function revokeForUser(User $user)
    {
        if ($this->firstParty()) {
            // not sure if necessary?
            throw new InvariantException('First party tokens cannot be revoked through this method.');
        }

        $user->getConnection()->transaction(function () use ($user) {
            $clientTokens = Token::where('user_id', $user->getKey())->where('client_id', $this->id);

            (clone $clientTokens)->update([
                'revoked' => true,
                'updated_at' => now('UTC'),
            ]);

            $user->getConnection()
                // force mysql optimizer to optimize properly with a fake multi-table update
                // https://dev.mysql.com/doc/refman/8.0/en/subquery-optimization.html
                ->table(DB::raw('oauth_refresh_tokens, (SELECT 1) dummy'))
                ->whereIn('access_token_id', (clone $clientTokens)->select('id'))
                ->update(['revoked' => true]);
        });
    }

    public function revoke()
    {
        $this->getConnection()->transaction(function () {
            $now = now('UTC');

            $this->tokens()->update(['revoked' => true, 'updated_at' => $now]);
            $this->refreshTokens()->update([(new RefreshToken)->qualifyColumn('revoked') => true]);
            $this->authCodes()->update(['revoked' => true]);
            $this->update(['revoked' => true, 'updated_at' => $now], ['skipValidations' => true]);
        });
    }

    public function save(array $options = [])
    {
        if (!($options['skipValidations'] ?? false) && !$this->isValid()) {
            return false;
        }

        return parent::save($options);
    }

    public function scopeThirdParty($query)
    {
        return $query->where('personal_access_client', false)->where('password_client', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'oauth.client';
    }
}
