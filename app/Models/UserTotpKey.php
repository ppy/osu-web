<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\UserVerificationException;
use BaconQrCode\Renderer\PlainTextRenderer;
use BaconQrCode\Writer;
use OTPHP\Factory;
use OTPHP\TOTP;

/**
 * @property int $user_id
 * @property string $uri
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read User $user
 */
class UserTotpKey extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'user_id';

    public static function createOrFirstForUser(User $user): static
    {
        $existingKey = $user->userTotpKey;

        if ($existingKey !== null) {
            return $existingKey;
        }

        $key = $user->userTotpKey()->createOrFirst([], [
            'uri' => static::generateUri($user),
        ]);
        $user->setRelation('userTotpKey', $key);

        return $key;
    }

    public static function digits(): int
    {
        return TOTP::DEFAULT_DIGITS;
    }

    public static function generateUri(User $user): string
    {
        $totp = TOTP::generate();
        $totp->setIssuer('osu!');
        // this assumes username to never contain colon `:`
        $totp->setLabel($user->username);

        return $totp->getProvisioningUri();
    }

    public static function isValidKey(string $uri, string $key): bool
    {
        return Factory::loadFromProvisioningUri($uri)->verify($key, null, 10);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function totp()
    {
        return Factory::loadFromProvisioningUri($this->uri);
    }

    public function assertValidKey(string $key): void
    {
        if (!static::isValidKey($this->uri, $key)) {
            throw new UserVerificationException('incorrect_key', false);
        }

        // only allow each keys to be used once
        if (!\Cache::add("totp:{$this->getKey()}:{$key}", '1', 120)) {
            throw new UserVerificationException('totp_used_key', false);
        }
    }

    public function getQrCodeCli(): string
    {
        return new Writer(new PlainTextRenderer())->writeString($this->uri);
    }
}
