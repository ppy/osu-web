<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries;

use App\Exceptions\UserVerificationException;
use App\Mail\UserVerification as UserVerificationMail;
use App\Models\Country;
use Mail;

class UserVerification
{
    private $request;
    private $state;
    private $user;

    public static function fromCurrentRequest()
    {
        return new static(
            auth()->user(),
            request(),
            UserVerificationState::fromCurrentRequest()
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
        // Workaround race condition causing $this->issue() to be called in parallel.
        // Mainly observed when logging in as privileged user.
        if ($this->request->ajax() && $this->request->is('home/notifications')) {
            return response(['error' => 'verification'], 401);
        }

        $email = $this->user->user_email;

        if (!$this->state->issued()) {
            $this->issue();
        }

        if ($this->request->ajax()) {
            return response([
                'authentication' => 'verify',
                'box' => render_to_string(
                    'users._verify_box',
                    compact('email')
                ),
            ], 401);
        } else {
            return response()->view('users.verify', compact('email'));
        }
    }

    public function isDone()
    {
        return $this->state->isDone();
    }

    public function issue()
    {
        $user = $this->user;
        $email = $user->user_email;
        $to = $user->user_email;
        $keys = $this->state->issue();

        $requestCountry = Country
            ::where('acronym', request_country($this->request))
            ->pluck('name')
            ->first();

        Mail::to($to)
            ->queue(new UserVerificationMail(
                compact('keys', 'user', 'requestCountry')
            ));
    }

    public function markVerifiedAndRespond()
    {
        $this->state->markVerified();

        return response([], 200);
    }

    public function reissue()
    {
        if ($this->state->isDone()) {
            return $this->markVerifiedAndRespond();
        }

        $this->issue();

        return response(['message' => trans('user_verification.errors.reissued')], 200);
    }

    public function verify()
    {
        $key = str_replace(' ', '', $this->request->input('verification_key'));

        try {
            $this->state->verify($key);
        } catch (UserVerificationException $e) {
            if ($e->shouldReissue()) {
                $this->issue();
            }

            return error_popup($e->getMessage());
        }

        return $this->markVerifiedAndRespond();
    }
}
