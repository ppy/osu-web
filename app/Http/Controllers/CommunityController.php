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

use Cache;
use Auth;
use Redirect;
use Illuminate\Http\Request as HttpRequest;
use App\Models\SlackUser;

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

    public function getChat()
    {
        return view('community.chat');
    }

    public function getLive(HttpRequest $request)
    {
        $featuredStream = null;
        $streams = Cache::remember('livestreams', 5, function () {
            $twitchApiUrl = config('osu.urls.twitch_livestreams_api');
            $data = json_decode(file_get_contents($twitchApiUrl));

            return $data->streams;
        });

        //dirty hack to add https urls to images
        //with allowance from nanaya
        foreach ($streams as &$stream) {
            foreach ($stream->preview as &$preview) {
                $preview = str_replace('http:', 'https:', $preview);
            }
        }

        $featuredStreamId = Cache::get('featuredStream');
        if ($featuredStreamId !== null) {
            $featuredStreamId = (string) $featuredStreamId;
            foreach ($streams as $stream) {
                if ((string) $stream->_id !== $featuredStreamId) {
                    continue;
                }
                $featuredStream = $stream;
                break;
            }
        }

        return view('community.live', compact('streams', 'featuredStream'));
    }

    public function postLive(HttpRequest $request)
    {
        if (Auth::check() !== true || Auth::user()->isGmt() !== true) {
            abort(403);
        }

        if ($request->has('promote')) {
            Cache::forever('featuredStream', (string) $request->promote);
        }

        if ($request->has('demote')) {
            Cache::forget('featuredStream');
        }

        return Redirect::back();
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
            $accepted = $user->isSlackAccepted();

            if ($accepted) {
                $slackUser = $user->slackUser()->first();

                if ($slackUser->slack_id !== null) {
                    $isInviteAccepted = true;
                }
            }
        }

        return view('community.slack', compact('isEligible', 'accepted', 'isInviteAccepted', 'mail'));
    }

    public function postSlackAgree()
    {
        $message = 'errors.unknown';

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->isSlackEligible()) {
                $token = config('slack.token');
                $contents = file_get_contents("https://osu-public.slack.com/api/users.admin.invite?email={$user->user_email}&token={$token}&set_active=true");

                if ($contents) {
                    $contents = json_decode($contents, true);

                    if ($contents['ok'] === true) {
                        $user->slackUser()->create([]);

                        return ['ok' => true];
                    } else {
                        return error_popup(trans($message));
                    }
                } else {
                    return error_popup(trans($message));
                }
            } else {
                return error_popup(trans($message));
            }
        } else {
            abort(403);
        }
    }
}
