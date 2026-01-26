<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\User\PasswordResetFailException;
use App\Libraries\User\PasswordResetData;
use App\Models\User;
use App\Models\UserAccountHistory;
use Carbon\CarbonImmutable;

class PasswordResetController extends Controller
{
    private static function getUser(?string $username): ?User
    {
        return present($username) ? User::findForLogin($username, true) : null;
    }

    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest');
        $this->middleware('throttle:60,10');
        $this->middleware('throttle:20,1440,password-reset:');
    }

    public function create()
    {
        $username = get_string(\Request::input('username'));
        $user = static::getUser($username);
        $error = PasswordResetData::create($user, $username);

        if ($error === null) {
            \Session::flash('popup', osu_trans('password_reset.notice.sent'));

            return ujs_redirect(route('password-reset.reset', [
                'username' => $username,
            ]));
        } else {
            return response(['form_error' => [
                'username' => [$error],
            ]], 422);
        }
    }

    public function index()
    {
        return ext_view('password_reset.index');
    }

    public function resendMail()
    {
        $username = get_string(\Request::input('username'));
        $user = static::getUser($username) ?? abort(422);
        $data = PasswordResetData::find($user, $username);

        if ($data === null) {
            \Session::flash('popup', osu_trans('password_reset.error.expired'));

            return ujs_redirect(route('password-reset'));
        } elseif ($data->sendMail(true)) {
            $data->save();
        }

        return ['message' => osu_trans('password_reset.notice.sent')];
    }

    public function reset()
    {
        $username = presence(get_string(\Request::input('username'))) ?? abort(422);

        return ext_view('password_reset.reset', compact('username'));
    }

    public function update()
    {
        $params = get_params(\Request::all(), null, [
            'key',
            'user.password',
            'user.password_confirmation',
            'username',
        ], ['null_missing' => true]);

        try {
            $user = static::getUser($params['username'])
                ?? throw new PasswordResetFailException('invalid');
            $data = PasswordResetData::find($user, $params['username'])
                ?? throw new PasswordResetFailException('invalid');

            if (!$data->isActive()) {
                throw new PasswordResetFailException('expired');
            }

            $params['key'] = strtr($params['key'] ?? '', [' ' => '']);
            if (!present($params['key'])) {
                return response(['form_error' => [
                    'key' => [osu_trans('password_reset.error.missing_key')],
                ]], 422);
            }

            if (!$data->isValidKey($params['key'])) {
                if (!$data->hasMoreTries()) {
                    throw new PasswordResetFailException('too_many_tries');
                }

                $data->save();

                return response(['form_error' => [
                    'key' => [osu_trans('password_reset.error.wrong_key')],
                ]], 422);
            }
        } catch (PasswordResetFailException $e) {
            if (isset($data)) {
                $data->delete();
            }

            \Session::flash('popup', osu_trans("password_reset.error.{$e->getMessage()}"));

            return ujs_redirect(route('password-reset'));
        }

        $user->validatePasswordConfirmation();
        $params['user']['user_lastvisit'] = CarbonImmutable::now();
        if ($user->update($params['user'])) {
            $user->resetSessions();
            $this->login($user);

            UserAccountHistory::logUserResetPassword($user);
            $data->delete();

            \Session::flash('popup', osu_trans('password_reset.notice.saved'));

            return ujs_redirect(route('home'));
        } else {
            return response(['form_error' => [
                'user' => $user->validationErrors()->all(),
            ]], 422);
        }
    }
}
