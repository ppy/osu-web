<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\UserVerificationException;
use App\Mail\UserVerification as UserVerificationMail;
use App\Models\Country;
use App\Models\LoginAttempt;
use Datadog;
use Mail;

class UserVerification
{
    private $request;
    private $state;
    private $user;

    public static function fromCurrentRequest()
    {
        $verification = request()->attributes->get('user_verification');

        if ($verification === null) {
            $verification = new static(
                auth()->user(),
                request(),
                UserVerificationState::fromCurrentRequest()
            );
            request()->attributes->set('user_verification', $verification);
        }

        return $verification;
    }

    public static function logAttempt(string $source, string $type, string $reason = null): void
    {
        Datadog::increment(
            config('datadog-helper.prefix_web').'.verification.attempts',
            1,
            compact('reason', 'source', 'type')
        );
    }

    private function __construct($user, $request, $state)
    {
        $this->user = $user;
        $this->request = $request;
        $this->state = $state;
    }

    public function initiate()
    {
        $statusCode = 401;
        app('route-section')->setError("{$statusCode}-verification");

        // Workaround race condition causing $this->issue() to be called in parallel.
        // Mainly observed when logging in as privileged user.
        if ($this->request->ajax()) {
            $routeData = app('route-section')->getOriginal();
            if ($routeData['controller'] === 'notifications_controller' && $routeData['action'] === 'index') {
                return response(['error' => 'verification'], $statusCode);
            }
        }

        $email = $this->user->user_email;

        if (!$this->state->issued()) {
            static::logAttempt('input', 'new');

            $this->issue();
        }

        if ($this->request->ajax()) {
            return response([
                'authentication' => 'verify',
                'box' => view(
                    'users._verify_box',
                    compact('email')
                )->render(),
            ], $statusCode);
        } else {
            return ext_view('users.verify', compact('email'), null, $statusCode);
        }
    }

    public function isDone()
    {
        return $this->state->isDone();
    }

    public function issue()
    {
        $user = $this->user;

        if (!present($user->user_email)) {
            return;
        }

        $keys = $this->state->issue();

        LoginAttempt::logAttempt($this->request->getClientIp(), $this->user, 'verify');

        $requestCountry = Country
            ::where('acronym', request_country($this->request))
            ->pluck('name')
            ->first();

        Mail::to($user)
            ->queue(new UserVerificationMail(
                compact('keys', 'user', 'requestCountry')
            ));
    }

    public function markVerified()
    {
        $this->state->markVerified();
    }

    public function markVerifiedAndRespond()
    {
        $this->markVerified();

        return response([], 200);
    }

    public function reissue()
    {
        if ($this->state->isDone()) {
            return $this->markVerifiedAndRespond();
        }

        $this->issue();

        return response(['message' => osu_trans('user_verification.errors.reissued')], 200);
    }

    public function verify()
    {
        $key = str_replace(' ', '', $this->request->input('verification_key'));

        try {
            $this->state->verify($key);
        } catch (UserVerificationException $e) {
            static::logAttempt('input', 'fail', $e->reasonKey());

            if ($e->reasonKey() === 'incorrect_key') {
                LoginAttempt::logAttempt($this->request->getClientIp(), $this->user, 'verify-mismatch', $key);
            }

            if ($e->shouldReissue()) {
                $this->issue();
            }

            return error_popup($e->getMessage());
        }

        static::logAttempt('input', 'success');

        return $this->markVerifiedAndRespond();
    }
}
