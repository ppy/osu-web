<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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

use App\Models\Country;
use App\Models\LegacySession;
use Carbon\Carbon;
use Mail;

class UserVerification
{
    const VERIFIED = 10;

    protected $user;

    private $_legacySession = false;

    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function initiate()
    {
        $email = $this->user->user_email;

        if (!present($this->request->session()->get('verification_key'))) {
            $this->issue();
        }

        if ($this->request->ajax()) {
            return response([
                'authentication' => 'verify',
                'box' => view()
                    ->make('users._verify_box', compact('email'))
                    ->render(),
            ], 401);
        } else {
            return response()->view('users.verify');
        }
    }

    public function issue()
    {
        // 1 byte = 2^8 bits = 16^2 bits = 2 hex characters
        $key = bin2hex(random_bytes(config('osu.user.verification_key_length_hex') / 2));
        $email = $this->user->user_email;
        $from = config('osu.emails.account');
        $to = $this->user->user_email;

        $this->request->session()->put('verification_key', $key);
        $this->request->session()->put('verification_expire_date', Carbon::now()->addHours(5));
        $this->request->session()->put('verification_tries', 0);

        $countryName = Country
            ::where('acronym', $this->request->header('CF_IPCOUNTRY'))
            ->pluck('name')
            ->first();

        Mail::queue(
            ['text' => i18n_view('emails.user_verification')],
            ['key' => $key, 'user' => $this->user],
            function ($message) use ($from, $to) {
                $message->from($from);
                $message->to($to);
                $message->subject(trans('user_verification.email.subject'));
            }
        );
    }

    public function isDone()
    {
        if ($this->user === null) {
            return true;
        }

        if ($this->request->session()->get('verified') === static::VERIFIED) {
            return true;
        }

        return $this->isDoneLegacy();
    }

    public function isDoneLegacy()
    {
        return $this->legacySession() !== null
            && $this->legacySession()->verified;
    }

    public function legacySession()
    {
        if ($this->_legacySession === false) {
            $session = LegacySession::loadFromRequest($this->request);

            if ($session !== null
                && $session->session_user_id !== $this->user->user_id) {
                $session = null;
            }

            $this->_legacySession = $session;
        }

        return $this->_legacySession;
    }

    public function verified()
    {
        $this->request->session()->forget('verification_expire_date');
        $this->request->session()->forget('verification_tries');
        $this->request->session()->forget('verification_key');
        $this->request->session()->put('verified', static::VERIFIED);

        if ($this->legacySession() !== null) {
            $this->legacySession()->update(['verified' => true]);
        }

        return response([], 200);
    }

    public function verify()
    {
        if ($this->isDone()) {
            return $this->verified();
        }

        $expireDate = $this->request->session()->get('verification_expire_date');
        $tries = $this->request->session()->get('verification_tries');
        $key = $this->request->session()->get('verification_key');

        if (!present($expireDate) || !present($tries) || !present($key)) {
            $this->issue();

            return error_popup(trans('user_verification.errors.expired'));
        } elseif ($expireDate->isPast()) {
            $this->issue();

            return error_popup(trans('user_verification.errors.expired'));
        } elseif ($tries > config('osu.user.verification_key_tries_limit')) {
            $this->issue();

            return error_popup(trans('user_verification.errors.retries_exceeded'));
        } elseif (str_replace(' ', '', $this->request->input('verification_key')) !== $key) {
            $this->request->session()->put('verification_tries', $tries + 1);

            return error_popup(trans('user_verification.errors.incorrect_key'));
        } else {
            return $this->verified();
        }
    }
}
