<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Exceptions\InvalidScopeException;
use App\Models\User;
use Ds\Set;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    public $timestamps = true;

    /**
     * Whether the resource owner is delegated to the client's owner.
     *
     * @return bool
     */
    public function delegatesOwner(): bool
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
        if ($this->isClientCredentials() && $this->delegatesOwner()) {
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
        static $scopesRequireDelegation;
        $scopesRequireDelegation ??= new Set(['bot', 'chat.write']);

        if (empty($this->scopes)) {
            throw new InvalidScopeException('Tokens without scopes are not valid.');
        }

        if ($this->client === null) {
            throw new InvalidScopeException('The client is not authorized.', 'unauthorized_client');
        }

        $scopes = new Set($this->scopes);
        // no silly scopes.
        if ($scopes->contains('*') && $scopes->count() > 1) {
            throw new InvalidScopeException('* is not valid with other scopes');
        }

        if ($this->isClientCredentials()) {
            if ($scopes->contains('*')) {
                throw new InvalidScopeException('* is not allowed with Client Credentials');
            }

            if (!$scopes->intersect($scopesRequireDelegation)->isEmpty()) {
                if (!$this->delegatesOwner()) {
                    throw new InvalidScopeException('bot scope is required.');
                }

                // delegation is only allowed if scopes given allow delegation.
                if (!$scopes->diff($scopesRequireDelegation)->isEmpty()) {
                    throw new InvalidScopeException('delegation is not supported for this combination of scopes.');
                }
            }
        } else {
            // delegation is only available for client_credentials.
            if ($this->delegatesOwner()) {
                throw new InvalidScopeException('bot scope is only valid for client_credentials tokens.');
            }

            // only clients owned by bots are allowed to act on behalf of another user.
            if ($scopes->contains('chat.write') && !$this->client->user->isBot()) {
                throw new InvalidScopeException('This scope is only available for chat bots.');
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
