<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Events\UserSessionEvent;
use App\Interfaces\SessionVerificationInterface;

class Helper
{
    public static function currentSession(): SessionVerificationInterface
    {
        return is_api_request() ? oauth_token() : \Session::instance();
    }

    public static function logAttempt(string $source, string $type, ?string $reason = null): void
    {
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
