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
    public static function currentSession(): ?SessionVerificationInterface
    {
        return is_api_request() ? oauth_token() : \Session::instance();
    }

    public static function currentUserOrFail(): User
    {
        $user = \Auth::user();
        app('OsuAuthorize')->ensureLoggedIn($user);

        return $user;
    }

    public static function issue(SessionVerificationInterface $session, User $user, bool $initial = false): void
    {
        if ($initial) {
            if (State::fromSession($session) === null) {
                static::logAttempt('input', 'new');
            } else {
                return;
            }
        }

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

    public static function logAttempt(string $source, string $type, ?string $reason = null): void
    {
        datadog_increment(
            'verification.attempts',
            compact('reason', 'source', 'type')
        );
    }

    public static function markVerified(SessionVerificationInterface $session, State $state)
    {
        $session->markVerified();
        $state->delete();
        UserSessionEvent::newVerified($session->userId(), $session->getKeyForEvent())->broadcast();
    }
}
