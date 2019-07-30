<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
