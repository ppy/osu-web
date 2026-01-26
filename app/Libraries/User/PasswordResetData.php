<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Mail\PasswordReset;
use App\Models\User;

class PasswordResetData
{
    private const RESEND_MAIL_INTERVAL = 10;

    private string $cacheKey;

    private function __construct(
        public array $attrs,
        private readonly User $user,
        string $username
    ) {
        $this->cacheKey = static::cacheKey($this->user, $username);
    }

    /**
     * Rate limiter for password reset attempts
     *
     * This applies to both new reset request and resend mail request.
     */
    public static function attempt(User $user): bool
    {
        $limiterKey = "password_reset_user:{$user->getKey()}";
        if (\RateLimiter::remaining($limiterKey, 3) < 1) {
            return false;
        }

        \RateLimiter::increment($limiterKey, 86_400 * 7);

        return true;
    }

    public static function create(?User $user, ?string $username): ?string
    {
        if ($user === null || $username === null) {
            return osu_trans('password_reset.error.user_not_found');
        }

        if (static::find($user, $username) !== null) {
            return null;
        }

        if (!is_valid_email_format($user->user_email)) {
            return osu_trans('password_reset.error.contact_support');
        }

        if ($user->isPrivileged() && $user->user_password !== '') {
            return osu_trans('password_reset.error.is_privileged');
        }

        if (!static::attempt($user)) {
            return osu_trans('password_reset.error.too_many_requests');
        }

        $now = time();
        $data = new static([
            'authHash' => static::authHash($user),
            'canResendMailAfter' => $now + static::RESEND_MAIL_INTERVAL,
            'key' => bin2hex(random_bytes($GLOBALS['cfg']['osu']['user']['password_reset']['key_length'] / 2)),
            'expiresAt' => $now + $GLOBALS['cfg']['osu']['user']['password_reset']['expires_minute'] * 60,
            'tries' => 0,
        ], $user, $username);
        $data->sendMail(false);
        $data->save();

        return null;
    }

    public static function find(User $user, string $username): ?static
    {
        if ($user === null) {
            return null;
        }

        $attrs = \Cache::get(static::cacheKey($user, $username));

        if ($attrs === null) {
            return null;
        }

        return new static($attrs, $user, $username);
    }

    public static function cacheKey(User $user, string $username): string
    {
        $type = strpos($username, '@') === false
            ? 'username'
            : 'email';

        return "password_reset:data:{$user->getKey()}:{$type}";
    }

    private static function authHash(User $user): string
    {
        return hash('sha256', $user->user_email ?? '').':'.hash('sha256', $user->user_password);
    }

    public function delete(): void
    {
        \Cache::delete($this->cacheKey);
    }

    public function hasMoreTries(): bool
    {
        return $this->attrs['tries'] < $GLOBALS['cfg']['osu']['user']['password_reset']['tries'];
    }

    public function isActive(): bool
    {
        return hash_equals($this->attrs['authHash'], static::authHash($this->user));
    }

    public function isValidKey(string $key): bool
    {
        $isValid = hash_equals($this->attrs['key'], $key);

        if (!$isValid) {
            $this->attrs['tries']++;
        }

        return $isValid;
    }

    public function save(): void
    {
        \Cache::put($this->cacheKey, $this->attrs, $this->attrs['expiresAt'] - time());
    }

    public function sendMail(bool $isResending): bool
    {
        if ($isResending) {
            $now = time();

            if ($now < $this->attrs['canResendMailAfter'] || !static::attempt($this->user)) {
                return false;
            }
            $this->attrs['canResendMailAfter'] = $now + static::RESEND_MAIL_INTERVAL;
        }

        \Mail::to($this->user)->send(new PasswordReset([
            'user' => $this->user,
            'key' => $this->attrs['key'],
        ]));

        return true;
    }
}
