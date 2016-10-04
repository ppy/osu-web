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
use App\Transformers\AchievementTransformer;
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

        $this->middleware('auth', ['only' => [
            'checkUsernameAvailability',
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
            $usernameOrEmail = Request::input('username');
            $user = User::where('username', $usernameOrEmail)
                ->orWhere('user_email', $usernameOrEmail)
                ->first();

            $password = Request::input('password');
            $remember = Request::input('remember') === 'yes';

            $validAuth = $user === null
                ? false
                : Auth::getProvider()->validateCredentials($user, compact('password'));

            if ($validAuth) {
                Request::session()->flush();
                Request::session()->regenerateToken();
                Auth::login($user, $remember);

                return [
                    'header' => render_to_string('layout._header_user', ['_user' => Auth::user()]),
                    'header_popup' => render_to_string('layout._popup_user', ['_user' => Auth::user()]),
                    'user' => Auth::user()->defaultJson(),
                ];
            } else {
                LoginAttempt::failedAttempt($ip, $user);

                return error_popup('wrong password or email');
            }
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();

            // FIXME: Temporarily here for cross-site login, nuke after old site is... nuked.
            unset($_COOKIE['phpbb3_2cjk5_sid']);
            unset($_COOKIE['phpbb3_2cjk5_sid_check']);
            setcookie('phpbb3_2cjk5_sid', '', 1, '/', '.ppy.sh');
            setcookie('phpbb3_2cjk5_sid_check', '', 1, '/', '.ppy.sh');
        }

        Request::session()->flush();

        return [];
    }

    public function show($id)
    {
        $user = User::lookup($id);

        if ($user === null || !$user->hasProfile()) {
            abort(404);
        }

        if ((string) $user->user_id !== $id) {
            return ujs_redirect(route('users.show', $user));
        }

        $achievements = fractal_collection_array(
            Achievement::achievable()->orderBy('grouping')->orderBy('ordering')->orderBy('progression')->get(),
            new AchievementTransformer()
        );

        $userArray = fractal_item_array(
            $user,
            new UserTransformer(), implode(',', [
                'userAchievements',
                'allRankHistories',
                'allScores',
                'allScoresBest',
                'allScoresFirst',
                'allStatistics',
                'beatmapPlaycounts',
                'page',
                'recentActivities',
                'recentlyReceivedKudosu',
                'rankedAndApprovedBeatmapsets.beatmaps',
                'favouriteBeatmapsets.beatmaps',
            ])
        );

        return view('users.show', compact('user', 'userArray', 'achievements'));
    }
}
