<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Exceptions\InvalidScopeException;
use App\Models\User;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    public $timestamps = true;

    /**
     * Whether the token allows resource owner delegation.
     *
     * @return bool
     */
    public function canDelegate(): bool
    {
        return in_array('bot', $this->scopes, true);
    }

    /**
     * Resource owner for the token.
     *
     * For client_credentials grants, this is the client that requested the token;
     * otherwise, it is the user that authorized the token.
     */
    public function getResourceOwner(): ?User
    {
        if ($this->isClientCredentials() && $this->canDelegate()) {
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
            throw new InvalidScopeException('Tokens without scopes are not valid.');
        }

        if ($this->client === null) {
            throw new InvalidScopeException('The client is not authorized.', 'unauthorized_client');
        }

        if ($this->isClientCredentials() && in_array('*', $this->scopes, true)) {
            throw new InvalidScopeException('* is not allowed with Client Credentials');
        }

        if (in_array('chat.write', $this->scopes, true)) {
            // only clients owned by bots can request this scope.
            if (!$this->client->user->isBot()) {
                throw new InvalidScopeException('This scope is only available for chat bots.');
            }

            // in the case of client credentials, delegation must be enabled on the token.
            if ($this->isClientCredentials() && !$this->canDelegate()) {
                throw new InvalidScopeException('bot scope required.');
            }
        }

        if ($this->canDelegate()) {
            if (!$this->client->user->isBot()) {
                throw new InvalidScopeException('This scope is only available for chat bots.');
            }

            if (!$this->isClientCredentials()) {
                throw new InvalidScopeException('bot scope is only valid for client_credentials tokens.');
            }
        }

        return true;
    }

    public function save(array $options = [])
    {
        // Forces error if passport tries to issue an invalid client_credentials token.
        $this->validate();

        return parent::save($options);
    }

    public function user()
    {
        $provider = config('auth.guards.api.provider');

        return $this->belongsTo(config('auth.providers.'.$provider.'.model'), 'user_id');
    }
}
