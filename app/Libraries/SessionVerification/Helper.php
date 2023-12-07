<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Events\UserSessionEvent;
use App\Interfaces\SessionVerificationInterface;
use App\Mail\UserVerification as UserVerificationMail;
use App\Models\LoginAttempt;
use App\Models\User;

class Helper
{
    public static function issue(SessionVerificationInterface $session, User $user): void
    {
        if (!is_valid_email_format($user->user_email)) {
            return;
        }

        $state = State::create($session);
        $keys = [
            'link' => $state->linkKey,
            'main' => $state->key,
        ];

        $request = \Request::instance();
        LoginAttempt::logAttempt($request->getClientIp(), $user, 'verify');

        $requestCountry = app('countries')->byCode(request_country($request) ?? '')?->name;

        \Mail::to($user)
            ->queue(new UserVerificationMail(
                compact('keys', 'user', 'requestCountry')
            ));
    }

    public static function logAttempt(string $source, string $type, string $reason = null): void
    {
        \Datadog::increment(
            \Config::get('datadog-helper.prefix_web').'.verification.attempts',
            1,
            compact('reason', 'source', 'type')
        );
    }

    public static function markVerified(SessionVerificationInterface $session)
    {
        $session->markVerified();
        UserSessionEvent::newVerified($session->userId(), $session->getKeyForEvent())->broadcast();
    }
}
