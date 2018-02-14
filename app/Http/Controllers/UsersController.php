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
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\BeatmapsetEvent;
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

        $this->middleware(function ($request, $next) {
            $this->parsePaginationParams();

            return $next($request);
        }, [
            'only' => ['scores', 'beatmapsets', 'kudosu', 'recentActivity'],
        ]);

        return parent::__construct();
    }

    public function beatmapsetActivities($id)
    {
        // FIXME: camelCase
        $current_action = 'beatmapset_activities';

        priv_check('BeatmapDiscussionModerate')->ensureCan();

        $user = User::lookup($id, 'id', true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            abort(404);
        }

        $params = [
            'limit' => 10,
            'sort' => 'id-desc',
            'user' => $user->getKey(),
        ];

        $discussions = BeatmapDiscussion::search($params);
        $discussions['items'] = $discussions['query']->with([
                'user',
                'beatmapset',
                'startingPost',
            ])->get();

        $posts = BeatmapDiscussionPost::search($params);
        $posts['items'] = $posts['query']->with([
                'user',
                'beatmapset',
                'beatmapDiscussion',
                'beatmapDiscussion.beatmapset',
                'beatmapDiscussion.user',
                'beatmapDiscussion.startingPost',
            ])->get();

        $events = BeatmapsetEvent::search($params);
        $events['items'] = $events['query']->with(['user', 'beatmapset'])->get();

        $votes['items'] = BeatmapDiscussionVote::recentlyGivenByUser($user->getKey());
        $receivedVotes['items'] = BeatmapDiscussionVote::recentlyReceivedByUser($user->getKey());

        return view('users.beatmapset_activities', compact(
            'current_action',
            'discussions',
            'events',
            'posts',
            'user',
            'receivedVotes',
            'votes'
        ));
    }

    public function card($id)
    {
        $user = User::lookup($id);

        list($friend, $mutual) = $this->getFriendStatus($user);

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
        $user = User::lookup($username, 'string') ?? UserNotFound::instance();

        list($friend, $mutual) = $this->getFriendStatus($user);

        return [
            'user_id' => $user->user_id,
            'username' => $user->username,
            'card_html' => view('objects._usercard', compact('user', 'friend', 'mutual'))->render(),
        ];
    }

    public function scores($id, $type)
    {
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
        switch ($type) {
            case 'most_played':
                return $this->mostPlayedBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'favourite':
                return $this->favouriteBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'ranked_and_approved':
                return $this->rankedAndApprovedBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'unranked':
                return $this->unrankedBeatmapsets($this->user, $this->perPage, $this->offset);

            case 'graveyard':
                return $this->graveyardBeatmapsets($this->user, $this->perPage, $this->offset);

            default:
                abort(404);
        }
    }

    public function kudosu($id)
    {
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
                'user_achievements',
                'follower_count',
                'page',
                'recent_activity',
                'ranked_and_approved_beatmapset_count',
                'unranked_beatmapset_count',
                'graveyard_beatmapset_count',
                'favourite_beatmapset_count',
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

            $perPage = [
                'scoresBest' => 5,
                'scoresFirsts' => 5,
                'beatmapPlaycounts' => 5,
                'scoresRecent' => 5,

                'favouriteBeatmapsets' => 6,
                'rankedAndApprovedBeatmapsets' => 6,
                'unrankedBeatmapsets' => 6,
                'graveyardBeatmapsets' => 2,

                'recentlyReceivedKudosu' => 5,
            ];

            // Fetch perPage + 1 so the frontend can tell if there are more items
            // by comparing items count and perPage number.
            $beatmapsets = [
                'most_played' => $this->mostPlayedBeatmapsets($user, $perPage['beatmapPlaycounts'] + 1),
                'ranked_and_approved' => $this->rankedAndApprovedBeatmapsets($user, $perPage['rankedAndApprovedBeatmapsets'] + 1),
                'favourite' => $this->favouriteBeatmapsets($user, $perPage['favouriteBeatmapsets'] + 1),
                'unranked' => $this->unrankedBeatmapsets($user, $perPage['unrankedBeatmapsets'] + 1),
                'graveyard' => $this->graveyardBeatmapsets($user, $perPage['graveyardBeatmapsets'] + 1),
            ];

            $kudosu = $this->recentKudosu($user, $perPage['recentlyReceivedKudosu'] + 1);

            $scores = [
                'best' => $this->scoresBest($user, $currentMode, $perPage['scoresBest'] + 1),
                'firsts' => $this->scoresFirsts($user, $currentMode, $perPage['scoresFirsts'] + 1),
                'recent' => $this->scoresRecent($user, $currentMode, $perPage['scoresRecent'] + 1),
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
                'perPage' => $perPage,
            ];

            return view('users.show', compact(
                'user',
                'jsonChunks'
            ));
        }
    }

    private function getFriendStatus($user)
    {
        if (!(Auth::user()
            && $user
            && $user !== UserNotFound::instance())) {
            return [null, false];
        }

        $friend = Auth::user()
            ->friends()
            ->where('user_id', $user->user_id)
            ->first();

        return [$friend, $friend->mutual ?? false];
    }

    private function parsePaginationParams()
    {
        $this->user = User::lookup(Request::route('user'), 'id');
        if ($this->user === null || !priv_check('UserShow', $this->user)->can()) {
            abort(404);
        }

        $this->mode = Request::route('mode') ?? Request::input('mode') ?? $this->user->playmode;
        if (!array_key_exists($this->mode, Beatmap::MODES)) {
            abort(404);
        }

        $this->offset = get_int(Request::input('offset')) ?? 0;
        $perPage = clamp(get_int(request('limit')) ?? 5, 1, 21);

        if ($this->offset >= $this->maxResults) {
            $this->perPage = 0;
        } else {
            $this->perPage = min($perPage, $this->maxResults + 1 - $this->offset);
        }
    }

    public function recentActivity($id)
    {
        return json_collection(
            $this->user->events()->recent()
                ->limit($this->perPage)
                ->offset($this->offset)
                ->get(),
            'Event'
        );
    }

    private function recentKudosu($user, $perPage = 10, $offset = 0)
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

    private function mostPlayedBeatmapsets($user, $perPage = 10, $offset = 0)
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

    private function rankedAndApprovedBeatmapsets($user, $perPage = 10, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsRankedAndApproved()
                ->orderBy('approved_date', 'desc')
                ->limit($perPage)
                ->offset($offset)
                ->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function favouriteBeatmapsets($user, $perPage = 10, $offset = 0)
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

    private function unrankedBeatmapsets($user, $perPage = 10, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsUnranked()
                ->limit($perPage)
                ->orderBy('last_update', 'desc')
                ->offset($offset)
                ->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function graveyardBeatmapsets($user, $perPage = 10, $offset = 0)
    {
        return json_collection(
            $user->profileBeatmapsetsGraveyard()
                ->orderBy('last_update', 'desc')
                ->limit($perPage)
                ->offset($offset)
                ->get(),
            'BeatmapsetCompact',
            ['beatmaps']
        );
    }

    private function scoresBest($user, $mode, $perPage = 10, $offset = 0)
    {
        $scores = $user->scoresBest($mode, true)
            ->orderBy('pp', 'DESC')
            ->userBest($perPage, $offset, ['beatmap', 'beatmap.beatmapset']);

        ScoreBestModel::fillInPosition($scores);

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset', 'weight']);
    }

    private function scoresFirsts($user, $mode, $perPage = 10, $offset = 0)
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

    private function scoresRecent($user, $mode, $perPage = 10, $offset = 0)
    {
        $scores = $user->scores($mode, true)
            ->with('beatmap', 'beatmap.beatmapset')
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return json_collection($scores, 'Score', ['beatmap', 'beatmapset']);
    }
}
