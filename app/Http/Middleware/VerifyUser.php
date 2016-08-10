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
namespace App\Http\Middleware;

use App\Models\Country;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard as AuthGuard;
use Illuminate\Http\Request;
use Mail;

class VerifyUser
{
    const VERIFIED = 1;

    protected $auth;

    protected $except = [
        'oauth/authorize',
        'oauth/access_token',
    ];

    public function __construct(AuthGuard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->requiresVerification($request)) {
            if ($request->isMethod('post') && $request->input('verification_key')) {
                return $this->verify($request);
            } else {
                return $this->initiate($request);
            }
        }

        return $next($request);
    }

    public function initiate($request)
    {
        $email = $this->auth->user()->user_email;

        if (!present($request->session()->get('verification_key'))) {
            $this->issue($request);
        }

        if ($request->ajax()) {
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

    public function issue($request)
    {
        // 1 byte = 2^8 bits = 16^2 bits = 2 hex characters
        $key = bin2hex(random_bytes(config('osu.user.verification_key_length_hex') / 2));
        $email = $this->auth->user()->user_email;
        $from = config('osu.emails.account');
        $to = $this->auth->user()->user_email;

        $request->session()->put('verification_key', $key);
        $request->session()->put('verification_expire_date', Carbon::now()->addHours(5));
        $request->session()->put('verification_tries', 0);

        $countryName = Country
            ::where('acronym', $request->header('CF_IPCOUNTRY'))
            ->pluck('name')
            ->first();

        Mail::queue(
            ['text' => i18n_view('emails.user_verification')],
            ['key' => $key, 'user' => $this->auth->user()],
            function ($message) use ($from, $to) {
                $message->from($from);
                $message->to($to);
                $message->subject(trans('user_verification.email.subject'));
            }
        );

        return $key;
    }

    public function requiresVerification($request)
    {
        if ($request->session()->get('verified') === static::VERIFIED) {
            return false;
        }

        if ($this->auth->guest()) {
            return false;
        }

        if ($this->auth->user()->isPrivileged()) {
            return true;
        }

        return false;
    }

    public function verify($request)
    {
        $expireDate = $request->session()->get('verification_expire_date');
        $tries = $request->session()->get('verification_tries');
        $key = $request->session()->get('verification_key');

        if (!present($expireDate) || !present($tries) || !present($key)) {
            $this->issue($request);

            return error_popup(trans('user_verification.errors.expired'));
        } elseif ($expireDate->isPast()) {
            $this->issue($request);

            return error_popup(trans('user_verification.errors.expired'));
        } elseif ($tries > config('osu.user.verification_key_tries_limit')) {
            $this->issue($request);

            return error_popup(trans('user_verification.errors.retries_exceeded'));
        } elseif (str_replace(' ', '', $request->input('verification_key')) === $key) {
            $request->session()->forget('verification_expire_date');
            $request->session()->forget('verification_tries');
            $request->session()->forget('verification_key');
            $request->session()->put('verified', static::VERIFIED);

            return response([], 200);
        } else {
            $request->session()->put('verification_tries', $tries + 1);

            return error_popup(trans('user_verification.errors.incorrect_key'));
        }
    }
}
