<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\User;
use App\Models\UserAccountHistory;
use Carbon\Carbon;
use Mail;
use Request;
use Session;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest');
        $this->middleware('throttle:60,10');
        $this->middleware('throttle:20,1440,password-reset:');
    }

    public function destroy()
    {
        $this->clear();

        return ujs_redirect(route('password-reset'));
    }

    public function index()
    {
        $isStarted = Session::exists('password_reset');

        return ext_view('password_reset.index', compact('isStarted'));
    }

    public function create()
    {
        $error = $this->issue(Request::input('username'));

        if ($error === null) {
            return ['message' => osu_trans('password_reset.notice.sent')];
        } else {
            return response(['form_error' => [
                'username' => [$error],
            ]], 422);
        }
    }

    public function update()
    {
        $session = Session::get('password_reset');

        if ($session === null) {
            return $this->restart('invalid');
        }

        if ($session['expire']->isPast()) {
            return $this->restart('expired');
        }

        $user = User::find($session['user_id']);

        if ($user === null) {
            return $this->restart('invalid');
        }

        if (!hash_equals($session['auth_hash'], $user->authHash())) {
            return $this->restart('expired');
        }

        $inputKey = str_replace(' ', '', Request::input('key'));

        if (!present($inputKey)) {
            return response(['form_error' => [
                'key' => [osu_trans('password_reset.error.missing_key')],
            ]], 422);
        }

        if (!hash_equals($session['key'], $inputKey)) {
            // wrong key
            $tries = $session['tries'] + 1;

            if ($tries >= config('osu.user.password_reset.tries')) {
                return $this->restart('too_many_tries');
            }

            Session::put('password_reset.tries', $tries);

            return response(['form_error' => [
                'key' => [osu_trans('password_reset.error.wrong_key')],
            ]], 422);
        }

        $params = get_params(request()->all(), 'user', ['password', 'password_confirmation']);
        $user->validatePasswordConfirmation();

        if ($user->update($params)) {
            $this->clear();
            $this->login($user);

            UserAccountHistory::logUserResetPassword($user);

            return ['message' => osu_trans('password_reset.notice.saved')];
        } else {
            return response(['form_error' => [
                'user' => $user->validationErrors()->all(),
            ]], 422);
        }
    }

    private function clear()
    {
        Session::forget('password_reset');
    }

    private function issue($username)
    {
        $user = User::findForLogin($username, true);

        if ($user === null) {
            return osu_trans('password_reset.error.user_not_found');
        }

        if (!present($user->user_email)) {
            return osu_trans('password_reset.error.contact_support');
        }

        if ($user->isPrivileged() && $user->user_password !== '') {
            return osu_trans('password_reset.error.is_privileged');
        }

        $session = [
            'auth_hash' => $user->authHash(),
            'username' => $username,
            'user_id' => $user->user_id,
            'key' => bin2hex(random_bytes(config('osu.user.password_reset.key_length') / 2)),
            'expire' => Carbon::now()->addHours(config('osu.user.password_reset.expires_hour')),
            'tries' => 0,
        ];

        Session::put('password_reset', $session);

        Mail::to($user)->send(new PasswordReset([
            'user' => $user,
            'key' => $session['key'],
        ]));
    }

    private function restart($reasonKey)
    {
        $this->clear();

        return ['message' => osu_trans("password_reset.error.{$reasonKey}")];
    }
}
