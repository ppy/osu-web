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

use App\Libraries\UserRegistration;
use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Country;
use App\Models\IpBan;
use App\Models\Score\Best\Model as ScoreBestModel;
use App\Models\User;
use App\Models\UserNotFound;
use Auth;
use Request;

class UsersController extends Controller
{
    protected $section = 'user';
    protected $maxResults = 100;

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'checkUsernameAvailability',
            'checkUsernameExists',
        ]]);

        $this->middleware('throttle:10,60', ['only' => ['store']]);

        return parent::__construct();
    }

    public function card($id)
    {
        $id = get_int($id);

        $user = User::lookup($id, 'id');
        $mutual = false;

        if (Auth::user()) {
            $friend = Auth::user()
                ->friends()
                ->where('user_id', $id)
                ->first();

            if ($friend) {
                $mutual = $friend->mutual;
            }
        }

        // render usercard as popup (i.e. pretty fade-in elements on load)
        $popup = true;

        return view('objects._usercard', compact('user', 'friend', 'mutual', 'popup'));
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

    public function checkUsernameExists()
    {
        $username = Request::input('username');
        $user = User::lookup($username) ?? UserNotFound::instance();

        $mutual = false;

        if (Auth::user()) {
            $friend = Auth::user()
                ->friends()
                ->where('user_id', $user->user_id)
                ->first();

            if ($friend) {
                $mutual = $friend->mutual;
            }
        }

        return [
            'user_id' => $user->user_id,
            'username' => $user->username,
            'card_html' => view('objects._usercard', compact('user', 'friend', 'mutual'))->render(),
        ];
    }

    public function scores($id, $type)
    {
        $this->parsePaginationParams(5);

        switch ($type) {
            case 'best':
                return $this->scoresBest($this->user, $this->mode, $this->perPage, $this->offset);

            case 'firsts':
                return $this->scoresFirsts($this->user, $this->mode, $this->perPage, $this->offset);

            case 'recent':
                return $this->scoresRecent($this->user, $this->mode, $this->perPage, $this->offset);

            default:
                abort(404);
        }
    }

    public function store()
    {
        $ip = Request::ip();

        if (IpBan::where('ip', '=', $ip)->exists()) {
            return error_popup('Banned IP', 403);
        }

        // Prevents browser-based form submission.
        // Javascript-side is prevented using CORS.
        if (!starts_with(Request::header('User-Agent'), config('osu.client.user_agent'))) {
            return error_popup('Wrong client', 403);
        }

        $params = get_params(request(), 'user', ['username', 'user_email', 'password']);
        $country = Country::find(request_country());
        $params['user_ip'] = $ip;
        $params['country_acronym'] = $country === null ? '' : $country->getKey();

        $registration = new UserRegistration($params);

        if ($registration->save()) {
            return $registration->user()->fresh()->defaultJson();
        } else {
            return response(['form_error' => [
                'user' => $registration->user()->validationErrors()->all(),
            ]], 422);
        }
    }

    public function beatmapsets($id, $type)
    {
        $this->parsePaginationParams(6);

        switch ($type) {
            case 'most_played':
                $this->parsePaginationParams(5);

                return $this->mostPlayedBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'favourite':
                return $this->favouriteBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'ranked_and_approved':
                return $this->rankedAndApprovedBeatmapsets($this->user, $this->perPage, $this->offset);

            default:
                abort(404);
        }
    }

    public function kudosu($id)
    {
        $this->parsePaginationParams(5);

        return $this->recentKudosu($this->user, $this->perPage, $this->offset);
    }

    public function me()
    {
        return self::show(Auth::user()->user_id);
    }

    public function show($id, $mode = null)
    {
        $user = User::lookup($id, null, true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            abort(404);
        }

        if ((string) $user->user_id !== (string) $id) {
            return ujs_redirect(route('users.show', ['user' => $user, 'mode' => $mode]));
        }

        $currentMode = $mode ?? $user->playmode;

        if (!array_key_exists($currentMode, Beatmap::MODES)) {
            abort(404);
        }

        $userArray = json_item(
            $user,
            'User',
            [
                'userAchievements',
                'followerCount',
                'page',
                'recentActivities',
                'rankedAndApprovedBeatmapsetCount',
                'favouriteBeatmapsetCount',
            ]
        );

        $statistics = json_item(
            $user->statistics($currentMode),
            'UserStatistics',
            ['rank', 'scoreRanks']
        );

        $rankHistoryData = $user->rankHistories()
            ->where('mode', Beatmap::modeInt($currentMode))
            ->first();

        $rankHistory = $rankHistoryData ? json_item($rankHistoryData, 'RankHistory') : [];

        if (Request::is('api/*')) {
            $userArray['statistics'] = $statistics;
            $userArray['rankHistory'] = $rankHistory;

            return $userArray;
        } else {
            $achievements = json_collection(
                Achievement::achievable()
                    ->orderBy('grouping')
                    ->orderBy('ordering')
                    ->orderBy('progression')
                    ->get(),
                'Achievement'
            );

            $beatmapsets = [
                'most_played' => $this->mostPlayedBeatmapsets($user),
                'ranked_and_approved' => $this->rankedAndApprovedBeatmapsets($user),
                'favourite' => $this->favouriteBeatmapsets($user),
            ];

            $kudosu = $this->recentKudosu($user);

            $scores = [
                'best' => $this->scoresBest($user, $currentMode),
                'firsts' => $this->scoresFirsts($user, $currentMode),
                'recent' => $this->scoresRecent($user, $currentMode),
            ];

            $jsonChunks = [
                'achievements' => $achievements,
                'beatmapsets' => $beatmapsets,
                'currentMode' => $currentMode,
                'kudosu' => $kudosu,
                'rankHistory' => $rankHistory,
                'scores' => $scores,
                'statistics' => $statistics,
                'user' => $userArray,
            ];

            return view('users.show', compact(
                'user',
                'jsonChunks'
            ));
        }
    }

    private function parsePaginationParams($perPage)
    {
        $this->user = User::lookup(Request::route('user'), 'id');
        if ($this->user === null || !priv_check('UserShow', $this->user)->can()) {
            abort(404);
        }

        $this->mode = Request::route('mode') ?? Request::input('mode') ?? $this->user->playmode;
        if (!array_key_exists($this->mode, Beatmap::MODES)) {
            abort(404);
        }

        $this->offset = get_int(Request::input('offset'));

        if ($this->offset >= $this->maxResults) {
            $this->perPage = 0;
        } else {
            $this->perPage = min($perPage, $this->maxResults - $this->offset);
        }
    }

    private function recentKudosu($user, $perPage = 5, $offset = 0)
    {
        return json_collection(
            $user->receivedKudosu()
                ->with('post', 'post.topic', 'giver', 'kudosuable')
                ->orderBy('exchange_id', 'desc')
                ->limit($perPage)
                ->offset($offset)
                ->get(),
            'KudosuHistory'
        );
    }

    private function mostPlayedBeatmapsets($user, $perPage = 5, $offset = 0)
    {
        $beatmapsets = $user->beatmapPlaycounts()
            ->with('beatmap', 'beatmap.beatmapset')
            ->orderBy('playcount', 'desc')
            ->orderBy('beatmap_id', 'desc') // for consistent sorting
            ->limit($perPage)
            ->offset($offset)
            ->get()
            ->filter(function ($pc) {
                return $pc->beatmap !== null && $pc->beatmap->beatmapset !== null;
            });

        return json_collection($beatmapsets, 'BeatmapPlaycount');
    }

    private function rankedAndApprovedBeatmapsets($user, $perPage = 6, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsRankedAndApproved()
                ->limit($perPage)
                ->offset($offset)
                ->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function favouriteBeatmapsets($user, $perPage = 6, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsFavourite()
                ->limit($perPage)
                ->offset($offset)
                ->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function scoresBest($user, $mode, $perPage = 5, $offset = 0)
    {
        $scores = $user->scoresBest($mode, true)
            ->orderBy('pp', 'DESC')
            ->userBest($perPage, $offset, ['beatmap', 'beatmap.beatmapset']);

        ScoreBestModel::fillInPosition($scores);

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset', 'weight']);
    }

    private function scoresFirsts($user, $mode, $perPage = 5, $offset = 0)
    {
        $scores = $user->scoresFirst($mode, true)
            ->orderBy('score_id', 'desc')
            ->with('beatmap', 'beatmap.beatmapset')
            ->limit($perPage)
            ->offset($offset)
            ->get();

        ScoreBestModel::fillInPosition($scores);

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset']);
    }

    private function scoresRecent($user, $mode, $perPage = 5, $offset = 0)
    {
        $scores = $user->scores($mode, true)
            ->with('beatmap', 'beatmap.beatmapset')
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset']);
    }
}
