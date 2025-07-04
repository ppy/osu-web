<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\OAuth;

use App\Events\UserSessionEvent;
use App\Exceptions\InvalidScopeException;
use App\Interfaces\SessionVerificationInterface;
use App\Models\Traits\FasterAttributes;
use App\Models\User;
use Ds\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken implements SessionVerificationInterface
{
    // PassportToken doesn't have factory
    use HasFactory, FasterAttributes;

    const SCOPES_REQUIRE_DELEGATION = ['chat.write', 'chat.write_manage', 'delegate'];

    protected $casts = [
        'expires_at' => 'datetime',
        'revoked' => 'boolean',
        'scopes' => 'array',
        'verified' => 'boolean',
    ];

    private ?Set $scopeSet;

    public static function findForVerification(string $id): ?static
    {
        return static::find($id);
    }

    public function refreshToken()
    {
        return $this->hasOne(RefreshToken::class, 'access_token_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Whether the resource owner is delegated to the client's owner.
     *
     * @return bool
     */
    public function delegatesOwner(): bool
    {
        return $this->scopeSet()->contains('delegate');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'client_id',
            'id',
            'name',
            'user_id' => $this->getRawAttribute($key),

            'revoked',
            'verified' => $this->getNullableBool($key),

            'scopes' => json_decode($this->getRawAttribute($key) ?? 'null', true),

            'created_at',
            'expires_at',
            'updated_at' => $this->getTimeFast($key),

            'client',
            'refreshToken',
            'user' => $this->getRelationValue($key),
        };
    }

    public function getKeyForEvent(): string
    {
        return "oauth:{$this->getKey()}";
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

    public function isOwnToken(): bool
    {
        $clientUserId = $this->client->user_id;

        return $clientUserId !== null && $clientUserId === $this->user_id;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function markVerified(): void
    {
        $this->update(['verified' => true]);
    }

    public function revokeRecursive()
    {
        $result = $this->revoke();
        $this->refreshToken?->revoke();

        return $result;
    }

    public function revoke()
    {
        $saved = parent::revoke();

        if ($saved && $this->user_id !== null) {
            UserSessionEvent::newLogout($this->user_id, [$this->getKeyForEvent()])->broadcast();
        }

        return $saved;
    }

    public function scopeValidAt($query, $time)
    {
        return $query->where('revoked', false)->where('expires_at', '>', $time);
    }

    public function setScopesAttribute(?array $value)
    {
        if ($value !== null) {
            sort($value);
        }

        $this->scopeSet = null;
        $this->attributes['scopes'] = $this->castAttributeAsJson('scopes', $value);
    }

    public function userId(): ?int
    {
        return $this->user_id;
    }

    public function validate(): void
    {
        static $scopesRequireDelegation = new Set(static::SCOPES_REQUIRE_DELEGATION);

        $scopes = $this->scopeSet();
        if ($scopes->isEmpty()) {
            throw new InvalidScopeException('Tokens without scopes are not valid.');
        }

        $client = $this->client;
        if ($client === null) {
            throw new InvalidScopeException('The client is not authorized.', 'unauthorized_client');
        }

        // no silly scopes.
        if ($scopes->contains('*')) {
            if ($scopes->count() > 1) {
                throw new InvalidScopeException('* is not valid with other scopes');
            }
        } elseif ($client->user === null) {
            // Only "*" scope is allowed for clients with no user
            throw new InvalidScopeException('The client is missing owner.');
        }

        if ($this->isClientCredentials()) {
            if ($scopes->contains('*')) {
                throw new InvalidScopeException('* is not allowed with Client Credentials');
            }

            if ($this->delegatesOwner() && !$client->user->isBot()) {
                throw new InvalidScopeException('Delegation with Client Credentials is only available to chat bots.');
            }

            if (!$scopes->intersect($scopesRequireDelegation)->isEmpty()) {
                if (!$this->delegatesOwner()) {
                    throw new InvalidScopeException('delegate scope is required.');
                }

                // delegation is only allowed if scopes given allow delegation.
                if (!$scopes->diff($scopesRequireDelegation)->isEmpty()) {
                    throw new InvalidScopeException('delegation is not supported for this combination of scopes.');
                }
            }
        } else {
            // delegation is only available for client_credentials.
            if ($this->delegatesOwner()) {
                throw new InvalidScopeException('delegate scope is only valid for client_credentials tokens.');
            }

            // only clients owned by bots are allowed to act on behalf of another user.
            // the user's own client can send messages as themselves for authorization code flows.
            static $ownClientScopes = new Set([
                'chat.read',
                'chat.write',
                'chat.write_manage',
            ]);
            if (!$scopes->intersect($ownClientScopes)->isEmpty() && !($this->isOwnToken() || $client->user->isBot())) {
                throw new InvalidScopeException('This scope is only available for chat bots or your own clients.');
            }
        }
    }

    public function save(array $options = [])
    {
        // Forces error if passport tries to issue an invalid client_credentials token.
        $this->validate();
        if (!$this->exists) {
            $this->setVerifiedState();
        }

        return parent::save($options);
    }

    private function scopeSet(): Set
    {
        return $this->scopeSet ??= new Set($this->scopes ?? []);
    }

    private function setVerifiedState(): void
    {
        // client credential doesn't have user attached and auth code is
        // already verified during grant process
        $this->verified ??= $GLOBALS['cfg']['osu']['user']['bypass_verification']
            || $this->user === null
            || !$this->client->password_client;
    }
}
