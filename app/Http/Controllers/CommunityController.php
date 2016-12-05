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

use App\Models\SlackUser;
use Auth;

class CommunityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Community Controller
    |--------------------------------------------------------------------------
    |
    | Frontend to the community of osu!
    | Unsure if forum should use /forum or not.
    | Route:
    |
    |	Route::get('/community</page>', 'CommunityController@get<Page>');
    |
    */
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['only' => ['postSlackAgree']]);
    }

    public function getChat()
    {
        return view('community.chat');
    }

    public function getSlack()
    {
        $isEligible = false;
        $accepted = false;
        $isInviteAccepted = false;
        $supportMail = config('osu.emails.account');

        if (Auth::check()) {
            $user = Auth::user();

            $isEligible = $user->isSlackEligible();

            if ($user->slackUser !== null) {
                $accepted = true;
                $isInviteAccepted = $user->slackUser->slack_id !== null;
            }
        }

        return view('community.slack', compact('isEligible', 'accepted', 'isInviteAccepted', 'supportMail'));
    }

    public function postSlackAgree()
    {
        $user = Auth::user();

        if ($user->isSlackEligible() === false) {
            return error_popup(trans('errors.community.slack.not-eligible'));
        }

        $token = config('slack.token');
        $contents = file_get_contents("https://osu-public.slack.com/api/users.admin.invite?email={$user->user_email}&token={$token}&set_active=true");

        if ($contents === false) {
            return error_popup(trans('errors.community.slack.slack-error'));
        }

        $contents = json_decode($contents, true);

        if ($contents['ok'] === true) {
            $user->slackUser()->create([]);

            return ['ok' => true];
        } else {
            return error_popup(trans(trans('errors.community.slack.slack-error')));
        }
    }
}
