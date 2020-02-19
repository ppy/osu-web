<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Libraries\Search\PostSearch;
use App\Libraries\Search\PostSearchRequestParams;
use App\Libraries\UserRegistration;
use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Country;
use App\Models\IpBan;
use App\Models\Log;
use App\Models\User;
use App\Models\UserAccountHistory;
use App\Models\UserNotFound;
use Auth;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use Illuminate\Cache\RateLimiter;
use Request;

class UsersController extends Controller
{
    protected $section = 'user';
    protected $maxResults = 100;

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'store']);
        $this->middleware('auth', ['only' => [
            'checkUsernameAvailability',
            'checkUsernameExists',
            'report',
            'updatePage',
        ]]);

        $this->middleware('throttle:60,10', ['only' => ['store']]);

        if (is_api_request()) {
            $this->middleware('require-scopes:identify', ['only' => ['me']]);
        }

        $this->middleware(function ($request, $next) {
            $this->parsePaginationParams();

            return $next($request);
        }, [
            'only' => ['scores', 'beatmapsets', 'kudosu', 'recentActivity'],
        ]);

        return parent::__construct();
    }

    public function card($id)
    {
        // FIXME: if there's a username with the id of a restricted user,
        // it'll show the card of the non-restricted user.
        $user = User::lookup($id) ?? UserNotFound::instance();

        return json_item($user, 'UserCompact', ['cover', 'country']);
    }

    public function disabled()
    {
        return ext_view('users.disabled');
    }

    public function checkUsernameAvailability()
    {
        $username = Request::input('username') ?? '';

        $errors = Auth::user()->validateChangeUsername($username);

        $available = $errors->isEmpty();
        $message = $available ? "Username '".e($username)."' is available!" : $errors->toSentence();
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

        return json_item($user, 'UserCompact', ['cover', 'country']);
    }

    public function store()
    {
        if (!config('osu.user.allow_registration')) {
            return abort(403, 'User registration is currently disabled');
        }

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

        try {
            $registration->assertValid();

            if (get_bool(request('check'))) {
                return response(null, 204);
            }

            $throttleKey = "registration:{$ip}";

            if (app(RateLimiter::class)->tooManyAttempts($throttleKey, 10)) {
                abort(429);
            }

            $registration->save();
            app(RateLimiter::class)->hit($throttleKey, 600);

            return $registration->user()->fresh()->defaultJson();
        } catch (ValidationException $e) {
            return response(['form_error' => [
                'user' => $registration->user()->validationErrors()->all(),
            ]], 422);
        }
    }

    public function beatmapsets($_userId, $type)
    {
        static $mapping = [
            'favourite' => 'favouriteBeatmapsets',
            'graveyard' => 'graveyardBeatmapsets',
            'loved' => 'lovedBeatmapsets',
            'most_played' => 'beatmapPlaycounts',
            'ranked_and_approved' => 'rankedAndApprovedBeatmapsets',
            'unranked' => 'unrankedBeatmapsets',
        ];

        $page = $mapping[$type] ?? abort(404);

        // Override per page restriction in parsePaginationParams to allow infinite paging
        $perPage = $this->sanitizedLimitParam();

        return $this->getExtra($this->user, $page, [], $perPage, $this->offset);
    }

    public function posts($id)
    {
        $user = User::lookup($id, 'id', true);
        if ($user === null || !priv_check('UserShow', $user)->can()) {
            abort(404);
        }

        $search = (new PostSearch(new PostSearchRequestParams(request()->all(), $user)))
            ->size(50);

        return ext_view('users.posts', compact('search', 'user'));
    }

    public function kudosu($_userId)
    {
        return $this->getExtra($this->user, 'recentlyReceivedKudosu', [], $this->perPage, $this->offset);
    }

    public function recentActivity($_userId)
    {
        return $this->getExtra($this->user, 'recentActivity', [], $this->perPage, $this->offset);
    }

    public function scores($_userId, $type)
    {
        static $mapping = [
            'best' => 'scoresBest',
            'firsts' => 'scoresFirsts',
            'recent' => 'scoresRecent',
        ];

        $page = $mapping[$type] ?? abort(404);

        $perPage = $this->perPage;

        if ($type === 'firsts') {
            // Override per page restriction in parsePaginationParams to allow infinite paging
            $perPage = $this->sanitizedLimitParam();
        }

        $json = $this->getExtra($this->user, $page, ['mode' => $this->mode], $perPage, $this->offset);

        return response($json, is_null($json['error'] ?? null) ? 200 : 504);
    }

    public function me($mode = null)
    {
        return static::show(auth()->user()->user_id, $mode);
    }

    public function show($id, $mode = null)
    {
        // Find matching id or username
        // If no user is found, search for a previous username
        // only if parameter is not a number (assume number is an id lookup).

        $user = User::lookupWithHistory($id, null, true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            if (is_json_request()) {
                abort(404);
            }

            return ext_view('users.show_not_found', null, null, 404);
        }

        if ((string) $user->user_id !== (string) $id) {
            return ujs_redirect(route('users.show', ['user' => $user, 'mode' => $mode]));
        }

        $currentMode = $mode ?? $user->playmode;

        if (!Beatmap::isModeValid($currentMode)) {
            abort(404);
        }

        $userIncludes = [
            "scores_first_count:mode({$currentMode})",
            "statistics:mode({$currentMode})",
            'account_history',
            'active_tournament_banner',
            'badges',
            'favourite_beatmapset_count',
            'follower_count',
            'graveyard_beatmapset_count',
            'loved_beatmapset_count',
            'monthly_playcounts',
            'page',
            'previous_usernames',
            'ranked_and_approved_beatmapset_count',
            'replays_watched_counts',
            'statistics.rank',
            'support_level',
            'unranked_beatmapset_count',
            'user_achievements',
        ];

        if (priv_check('UserSilenceShowExtendedInfo')->can() && !is_api_request()) {
            $userIncludes[] = 'account_history.actor';
            $userIncludes[] = 'account_history.supporting_url';
        }

        $userArray = json_item(
            $user,
            'User',
            $userIncludes
        );

        $rankHistoryData = $user->rankHistories()
            ->where('mode', Beatmap::modeInt($currentMode))
            ->first();

        $rankHistory = $rankHistoryData ? json_item($rankHistoryData, 'RankHistory') : null;

        if (is_api_request()) {
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
                'scoresRecent' => 5,

                'beatmapPlaycounts' => 5,
                'favouriteBeatmapsets' => 6,
                'rankedAndApprovedBeatmapsets' => 6,
                'lovedBeatmapsets' => 6,
                'unrankedBeatmapsets' => 6,
                'graveyardBeatmapsets' => 2,

                'recentActivity' => 5,
                'recentlyReceivedKudosu' => 5,
            ];

            $extras = [];

            foreach ($perPage as $page => $n) {
                // Fetch perPage + 1 so the frontend can tell if there are more items
                // by comparing items count and perPage number.
                $extras[$page] = $this->getExtra($user, $page, ['mode' => $currentMode], $n + 1);
            }

            $jsonChunks = [
                'achievements' => $achievements,
                'currentMode' => $currentMode,
                'extras' => $extras,
                'perPage' => $perPage,
                'rankHistory' => $rankHistory,
                'user' => $userArray,
            ];

            return ext_view('users.show', compact(
                'user',
                'jsonChunks'
            ));
        }
    }

    public function updatePage($id)
    {
        $user = User::findOrFail($id);

        priv_check('UserPageEdit', $user)->ensureCan();

        try {
            $user = $user->updatePage(request('body'));

            if (!$user->is(auth()->user())) {
                UserAccountHistory::logUserPageModerated($user, auth()->user());

                $this->log([
                    'log_type' => Log::LOG_USER_MOD,
                    'log_operation' => 'LOG_USER_PAGE_EDIT',
                    'log_data' => ['id' => $user->getKey()],
                ]);
            }

            return ['html' => $user->userPage->bodyHTML(['withoutImageDimensions' => true, 'modifiers' => ['profile-page']])];
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }
    }

    private function parsePaginationParams()
    {
        $this->user = User::lookup(Request::route('user'), 'id', true);
        if ($this->user === null || !priv_check('UserShow', $this->user)->can()) {
            abort(404);
        }

        $this->mode = Request::route('mode') ?? Request::input('mode') ?? $this->user->playmode;
        if (!Beatmap::isModeValid($this->mode)) {
            abort(404);
        }

        $this->offset = get_int(Request::input('offset')) ?? 0;

        if ($this->offset >= $this->maxResults) {
            $this->perPage = 0;
        } else {
            $perPage = $this->sanitizedLimitParam();
            $this->perPage = min($perPage, $this->maxResults - $this->offset);
        }
    }

    private function sanitizedLimitParam()
    {
        return clamp(get_int(request('limit')) ?? 5, 1, 51);
    }

    private function getExtra($user, $page, $options, $perPage = 10, $offset = 0)
    {
        try {
            // Grouped by $transformer and sorted alphabetically ($transformer and then $page).
            switch ($page) {
                // BeatmapPlaycount
                case 'beatmapPlaycounts':
                    $transformer = 'BeatmapPlaycount';
                    $query = $user->beatmapPlaycounts()
                        ->with('beatmap', 'beatmap.beatmapset')
                        ->whereHas('beatmap.beatmapset')
                        ->orderBy('playcount', 'desc')
                        ->orderBy('beatmap_id', 'desc'); // for consistent sorting
                    break;

                // Beatmapset
                case 'favouriteBeatmapsets':
                    $transformer = 'Beatmapset';
                    $includes = ['beatmaps'];
                    $query = $user->profileBeatmapsetsFavourite();
                    break;
                case 'graveyardBeatmapsets':
                    $transformer = 'Beatmapset';
                    $includes = ['beatmaps'];
                    $query = $user->profileBeatmapsetsGraveyard()
                        ->orderBy('last_update', 'desc');
                    break;
                case 'lovedBeatmapsets':
                    $transformer = 'Beatmapset';
                    $includes = ['beatmaps'];
                    $query = $user->profileBeatmapsetsLoved()
                        ->orderBy('approved_date', 'desc');
                    break;
                case 'rankedAndApprovedBeatmapsets':
                    $transformer = 'Beatmapset';
                    $includes = ['beatmaps'];
                    $query = $user->profileBeatmapsetsRankedAndApproved()
                        ->orderBy('approved_date', 'desc');
                    break;
                case 'unrankedBeatmapsets':
                    $transformer = 'Beatmapset';
                    $includes = ['beatmaps'];
                    $query = $user->profileBeatmapsetsUnranked()
                        ->orderBy('last_update', 'desc');
                    break;

                // Event
                case 'recentActivity':
                    $transformer = 'Event';
                    $query = $user->events()->recent();
                    break;

                // KudosuHistory
                case 'recentlyReceivedKudosu':
                    $transformer = 'KudosuHistory';
                    $query = $user->receivedKudosu()
                        ->with('post', 'post.topic', 'giver', 'kudosuable')
                        ->orderBy('exchange_id', 'desc');
                    break;

                // Score
                case 'scoresBest':
                    $transformer = 'Score';
                    $includes = ['beatmap', 'beatmapset', 'weight', 'user'];
                    $collection = $user->beatmapBestScores($options['mode'], $perPage, $offset, ['beatmap', 'beatmap.beatmapset', 'user']);
                    break;
                case 'scoresFirsts':
                    $transformer = 'Score';
                    $includes = ['beatmap', 'beatmapset', 'user'];
                    $query = $user->scoresFirst($options['mode'], true)
                        ->orderBy('score_id', 'desc')
                        ->with('beatmap', 'beatmap.beatmapset', 'user');
                    break;
                case 'scoresRecent':
                    $transformer = 'Score';
                    $includes = ['beatmap', 'beatmapset', 'user'];
                    $query = $user->scores($options['mode'], true)
                        ->with('beatmap', 'beatmap.beatmapset', 'best', 'user');
                    break;
            }

            if (!isset($collection)) {
                $collection = $query->limit($perPage)->offset($offset)->get();
            }

            return json_collection($collection, $transformer, $includes ?? []);
        } catch (ElasticsearchException $e) {
            return ['error' => search_error_message($e)];
        }
    }
}
