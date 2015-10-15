<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use App\Models\Achievement;
use App\Models\LoginAttempt;
use App\Models\User;
use App\Transformers\EventTransformer;
use App\Transformers\KudosuHistoryTransformer;
use App\Transformers\UserAchievementTransformer;
use App\Transformers\UserStatisticsTransformer;
use App\Transformers\UserTransformer;
use Auth;
use Request;

class UsersController extends Controller
{
    protected $section = 'user';

    public function __construct()
    {
        $this->middleware('guest', ['only' => [
            'login',
        ]]);

        return parent::__construct();
    }

    public function disabled()
    {
        return view('users.disabled');
    }

    public function checkUsernameAvailability()
    {
        $username = Request::input('username');

        $errors = Auth::user()->validateUsernameChangeTo($username);

        $available = count($errors) === 0;
        $message = $available ? "Username '".e($username)."' is available!" : implode(' ', $errors);
        $cost = $available ? Auth::user()->usernameChangeCost() : 0;

        return [
            'username' => Request::input('username'),
            'available' => $available,
            'message' => $message,
            'cost' => $cost,
            'costString' => currency($cost),
        ];
    }

    public function login()
    {
        $ip = Request::getClientIp();

        if (LoginAttempt::isLocked($ip)) {
            return error_popup('your IP address is locked. Please wait a few minutes.');
        } else {
            $username = Request::input('username');
            $password = Request::input('password');
            $remember = Request::input('remember') === 'yes';

            Auth::attempt(['username' => $username, 'password' => $password], $remember);

            if (Auth::check()) {
                return Auth::user()->defaultJson();
            } else {
                LoginAttempt::failedAttempt($ip, $username);

                return error_popup('wrong password or username');
            }
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return [];
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $user = User::find($id);
        } else {
            $user = User::where('username', $id)->orWhere('username_clean', $id)->first();
        }

        if ($user === null || !$user->hasProfile()) {
            abort(404);
        }

        $userArray = fractal_item_array(
            $user,
            new UserTransformer(),
            'allStatistics,page,recentAchievements,recentActivities,recentlyReceivedKudosu'
        );

        return view('users.show', compact('user', 'userArray'));
    }
}
