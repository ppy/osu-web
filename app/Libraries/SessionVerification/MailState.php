<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Exceptions\UserVerificationException;
use App\Interfaces\SessionVerificationInterface;
use App\Libraries\SignedRandomString;
use Carbon\CarbonImmutable;

class MailState
{
    private const KEY_VALID_DURATION = 600;

    public readonly CarbonImmutable $expiresAt;
    public readonly string $key;
    public readonly string $linkKey;
    public int $tries = 0;

    private function __construct(
        private readonly string $sessionClass,
        private readonly string $sessionId,
    ) {
        // 1 byte = 8 bits = 2^8 = 16^2 = 2 hex characters
        $this->key = bin2hex(random_bytes($GLOBALS['cfg']['osu']['user']['verification_key_length_hex'] / 2));
        $this->linkKey = SignedRandomString::create(32);
        $this->expiresAt = CarbonImmutable::now()->addSeconds(static::KEY_VALID_DURATION);
    }

    public static function create(SessionVerificationInterface $session): static
    {
        $state = new static($session::class, $session->getKey());
        $state->save(true);

        return $state;
    }

    public static function fromSession(SessionVerificationInterface $session): ?static
    {
        return \Cache::get(static::cacheKey($session::class, $session->getKey()));
    }

    public static function fromVerifyLink(string $linkKey): ?static
    {
        if (!SignedRandomString::isValid($linkKey)) {
            return null;
        }

        $cacheKey = \Cache::get(static::cacheLinkKey($linkKey));

        return $cacheKey === null ? null : \Cache::get($cacheKey);
    }

    private static function cacheKey(string $class, string $id): string
    {
        return "session_verification:{$class}:{$id}";
    }

    private static function cacheLinkKey(string $linkKey): string
    {
        return "session_verification_link:{$linkKey}";
    }

    public function delete(): void
    {
        \Cache::delete(static::cacheKey($this->sessionClass, $this->sessionId));
        \Cache::delete(static::cacheLinkKey($this->linkKey));
    }

    public function findSession(): ?SessionVerificationInterface
    {
        return $this->sessionClass::findForVerification($this->sessionId);
    }

    public function verify(string $inputKey): void
    {
        $this->tries++;

        if ($this->expiresAt->isPast()) {
            throw new UserVerificationException('expired', true);
        }

        if (!hash_equals($this->key, $inputKey)) {
            if ($this->tries >= $GLOBALS['cfg']['osu']['user']['verification_key_tries_limit']) {
                throw new UserVerificationException('retries_exceeded', true);
            } else {
                $this->save(false);
                throw new UserVerificationException('incorrect_key', false);
            }
        }
    }

    private function save(bool $saveLinkKey): void
    {
        $cacheKey = static::cacheKey($this->sessionClass, $this->sessionId);
        \Cache::put($cacheKey, $this, $this->expiresAt);
        if ($saveLinkKey) {
            \Cache::put(static::cacheLinkKey($this->linkKey), $cacheKey, $this->expiresAt);
        }
    }
}
