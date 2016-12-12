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
        $username = Request::input('username');
        $password = Request::input('password');
        $remember = Request::input('remember') === 'yes';

        $user = User::findForLogin($username);
        $authError = User::attemptLogin($user, $password, $ip);

        if ($authError === null) {
            Request::session()->flush();
            Request::session()->regenerateToken();
            Auth::login($user, $remember);

            return [
                'header' => render_to_string('layout._header_user'),
                'header_popup' => render_to_string('layout._popup_user'),
                'user' => Auth::user()->defaultJson(),
            ];
        } else {
            return error_popup($authError);
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
        $user = User::lookup($id, null, true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            abort(404);
        }

        if ((string) $user->user_id !== $id) {
            return ujs_redirect(route('users.show', $user));
        }

        $achievements = json_collection(
            Achievement::achievable()
                ->orderBy('grouping')
                ->orderBy('ordering')
                ->orderBy('progression')
                ->get(),
            new AchievementTransformer()
        );

        $userArray = json_item(
            $user,
            new UserTransformer(), [
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
            ]
        );

        return view('users.show', compact('user', 'userArray', 'achievements'));
    }
}
