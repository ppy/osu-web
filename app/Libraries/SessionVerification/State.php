<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\SessionVerification;

use App\Interfaces\SessionVerificationInterface;
use App\Mail\UserVerification as UserVerificationMail;
use App\Models\LoginAttempt;
use App\Models\User;

class State
{
    public function __construct(
        public SessionVerificationInterface $session,
        public User $user,
    ) {
    }

    public static function getCurrent(): static
    {
        return new static(Helper::currentSession(), \Auth::user());
    }

    public function getMethod(): string
    {
        $currentMethod = $this->session->getVerificationMethod();

        if ($currentMethod === null) {
            LoginAttempt::logAttempt(\Request::getClientIp(), $this->user, 'verify');

            // force mail to prevent client without totp support from showing wrong message
            $currentMethod = (is_api_request() && api_version() < 20250818) || $this->user->userTotpKey === null
                ? 'mail'
                : 'totp';

            $this->session->setVerificationMethod($currentMethod);
        }

        return $currentMethod;
    }

    public function issueMail(bool $initial): void
    {
        if ($initial) {
            if (MailState::fromSession($this->session) === null) {
                Helper::logAttempt('input', 'new');
            } else {
                return;
            }
        }

        if (!is_valid_email_format($this->user->user_email)) {
            return;
        }

        $mailState = MailState::create($this->session);
        $keys = [
            'link' => $mailState->linkKey,
            'main' => $mailState->key,
        ];

        $requestCountry = app('countries')->byCode(request_country() ?? '')?->name;

        \Mail::to($this->user)->queue(new UserVerificationMail([
            'keys' => $keys,
            'requestCountry' => $requestCountry,
            'user' => $this->user,
        ]));
    }

    public function markVerified(?MailState $mailState): void
    {
        Helper::markVerified($this->session, $mailState);
    }
}
