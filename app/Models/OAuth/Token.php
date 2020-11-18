<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Models\User;
use Laravel\Passport\Exceptions\MissingScopeException;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    public $timestamps = true;

    /**
     * Resource owner for the token.
     *
     * For client_credentials grants, this is the client that requested the token;
     * otherwise, it is the user that authorized the token.
     */
    public function getResourceOwner(): ?User
    {
        if ($this->isClientCredentials() && $this->scopes === ['bot']) {
            return $this->client->user;
        }

        return $this->user;
    }

    public function isClientCredentials()
    {
        // explicitly no user_id.
        return $this->user_id === null;
    }

    public function refreshToken()
    {
        return $this->hasOne(RefreshToken::class, 'access_token_id');
    }

    public function revokeRecursive()
    {
        $result = $this->revoke();
        optional($this->refreshToken)->revoke();

        return $result;
    }

    public function revoke()
    {
        $saved = parent::revoke();

        if ($saved && $this->user_id !== null) {
            event(UserSessionEvent::newLogout($this->user_id, ["oauth:{$this->getKey()}"]));
        }

        return $saved;
    }

    public function scopeValidAt($query, $time)
    {
        return $query->where('revoked', false)->where('expires_at', '>', $time);
    }

    public function validate()
    {
        if (empty($this->scopes)) {
            throw new MissingScopeException([], 'Tokens without scopes are not valid.');
        }

        if ($this->isClientCredentials() && in_array('*', $this->scopes, true)) {
            throw new MissingScopeException(['*'], '* is not allowed with Client Credentials');
        }

        if (in_array('bot', $this->scopes, true)) {
            if (count($this->scopes) !== 1) {
                throw new MissingScopeException(['bot'], 'bot scope is not allowed with other scopes.');
            }

            if (!$this->isClientCredentials()) {
                throw new MissingScopeException(['bot'], 'bot scope is only valid for client_credentials tokens.');
            }

            if (optional($this->getResourceOwner())->isBot() ?? false) {
                throw new MissingScopeException(['bot'], 'bot scope is is only valid for chat bots.');
            }
        }
    }

    public function user()
    {
        $provider = config('auth.guards.api.provider');

        return $this->belongsTo(config('auth.providers.'.$provider.'.model'), 'user_id');
    }
}
