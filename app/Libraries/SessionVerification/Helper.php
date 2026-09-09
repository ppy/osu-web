<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Events\UserSessionEvent;
use App\Interfaces\SessionVerificationInterface;
use App\Models\LoginAttempt;
use App\Models\User;

class Helper
{
    public static function currentSession(): SessionVerificationInterface
    {
        return is_api_request() ? oauth_token() : \Session::instance();
    }

    public static function logAttempt(string $ip, ?User $user, string $source, string $type, ?string $reason = null, ?string $key = null): void
    {
        if ($source === 'input' && $type === 'new') {
            $loginAttemptReason = 'verify';
        } elseif ($reason === 'incorrect_key') {
            $loginAttemptReason = 'verify-mismatch';
        } else {
            // rtrim in case reason is null
            $loginAttemptReason = rtrim(implode('-', ['verify', $source, $type, $reason]), '-');
        }

        LoginAttempt::logAttempt($ip, $user, $loginAttemptReason, $key, true);

        datadog_increment(
            'verification.attempts',
            compact('reason', 'source', 'type')
        );
    }
    public static function markVerified(SessionVerificationInterface $session, ?MailState $mailState): void
    {
        $session->markVerified();
        $mailState?->delete();
        UserSessionEvent::newVerified($session->userId(), $session->getKeyForEvent())->broadcast();
    }
}
