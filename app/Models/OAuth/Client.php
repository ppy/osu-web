<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use App\Exceptions\InvariantException;
use App\Models\User;
use App\Traits\Validatable;
use DB;
use Laravel\Passport\Client as PassportClient;
use Laravel\Passport\RefreshToken;

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

    public static function newFactory()
    {
        // force default factory class name instead of passport
        return null;
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

        if (!$this->exists && $this->user !== null) {
            $max = config('osu.oauth.max_user_clients');
            if ($this->user->oauthClients()->thirdParty()->where('revoked', false)->count() >= $max) {
                $this->validationErrors()->add('user.oauthClients.count', '.too_many');
            }
        }

        if (mb_strlen(trim($this->name)) === 0) {
            $this->validationErrors()->add('name', 'required');
        }

        $redirect = trim($this->redirect);
        // TODO: this url validation is not very good.
        if (present($redirect) && !filter_var($redirect, FILTER_VALIDATE_URL)) {
            $this->validationErrors()->add('redirect', '.url');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function resetSecret()
    {
        return $this->getConnection()->transaction(function () {
            $now = now('UTC');

            $this->revokeTokens($now);

            return $this->update(['secret' => str_random(40), 'updated_at' => $now], ['skipValidations' => true]);
        });
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

            $this->revokeTokens($now);
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

    private function revokeTokens($timestamp)
    {
        $this->tokens()->update(['revoked' => true, 'updated_at' => $timestamp]);
        $this->refreshTokens()->update([(new RefreshToken())->qualifyColumn('revoked') => true]);
        $this->authCodes()->update(['revoked' => true]);
    }
}
