<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\User;
use App\Models\UserPassword;
use Carbon\Carbon;
use Mail;
use Request;
use Session;

class PasswordResetController extends Controller
{
    protected $section = 'home';
    protected $actionPrefix = 'password-reset-';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest');
        $this->middleware('throttle:60,10');
    }

    public function destroy()
    {
        $this->clear();

        return ujs_redirect(route('password-reset'));
    }

    public function index()
    {
        $isStarted = Session::exists('password_reset');
        // show the email or username form
        // button
        return view('password_reset.index', compact('isStarted'));
    }

    public function sendMail()
    {
        $error = $this->issue(Request::input('username'));

        if ($error === null) {
            return ['message' => trans('password_reset.notice.sent')];
        } else {
            return error_popup($error);
        }
    }

    public function update()
    {
        $session = Session::get('password_reset');
        $user = User::find($session['user_id']);
        $inputKey = str_replace(' ', '', Request::input('key'));

        if ($user === null) {
            $this->clear();
            // something is horribly wrong
            return js_view('layout.ujs-reload');
        }

        if ($user->user_id !== $session['user_id']) {
            // something is very wrong
            $this->issue($username);

            return;
        }

        if ($session['expire']->isPast()) {
            $this->issue($session['username']);
            // too late

            return;
        }

        if ($session['tries'] > config('osu.user.password_reset.tries')) {
            // too fail
            $this->issue($session['username']);

            return;
        }

        if (!hash_equals($session['key'], $inputKey)) {
            // wrong key
            Session::put('password_reset.tries', $session['tries'] + 1);

            return error_popup('');
        }

        $userPassword = (new UserPassword($user, true))
            ->fill(Request::input('user_password'));

        if ($userPassword->save()) {
            $this->clear();

            return ['message' => 'saved!'];
        } else {
            return error_popup($userPassword->validationErrors()->all());
        }
    }

    private function clear()
    {
        Session::forget('password_reset');
    }

    private function issue($username)
    {
        $user = User::findForLogin($username);

        if ($user === null) {
            return trans('password_reset.error.user_not_found');
        }

        if (!present($user->user_email)) {
            return trans('password_reset.error.contact_support');
        }

        if ($user->isPrivileged()) {
            return trans('password_reset.error.is_privileged');
        }

        $session = [
            'username' => $username,
            'user_id' => $user->user_id,
            'key' => bin2hex(random_bytes(config('osu.user.password_reset.key_length') / 2)),
            'expire' => Carbon::now()->addHours(config('osu.user.password_reset.expires_hour')),
            'tries' => 0,
        ];

        Session::put('password_reset', $session);

        Mail::to($user->user_email)->send(new PasswordReset([
            'user' => $user,
            'key' => $session['key'],
        ]));
    }
}
