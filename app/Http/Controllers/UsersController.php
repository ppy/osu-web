<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Libraries\Search\ForumSearch;
use App\Libraries\Search\ForumSearchRequestParams;
use App\Libraries\UserRegistration;
use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\BeatmapDiscussion;
use App\Models\Country;
use App\Models\IpBan;
use App\Models\Log;
use App\Models\User;
use App\Models\UserAccountHistory;
use App\Models\UserNotFound;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserTransformer;
use Auth;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use Illuminate\Cache\RateLimiter;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Request;
use Sentry\State\Scope;

/**
 * @group Users
 */
class UsersController extends Controller
{
    protected $maxResults = 100;

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'store']);
        $this->middleware('auth', ['only' => [
            'checkUsernameAvailability',
            'checkUsernameExists',
            'report',
            'me',
            'posts',
            'updatePage',
        ]]);

        $this->middleware('throttle:60,10', ['only' => ['store']]);

        $this->middleware('require-scopes:identify', ['only' => ['me']]);
        $this->middleware('require-scopes:public', ['only' => [
            'beatmapsets',
            'kudosu',
            'recentActivity',
            'scores',
            'show',
        ]]);

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
        $user = $this->lookupUser($id) ?? UserNotFound::instance();

        return json_item($user, 'UserCompact', UserCompactTransformer::CARD_INCLUDES);
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
        $user = User::lookup($username, 'username') ?? UserNotFound::instance();

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

        $params = get_params(request()->all(), 'user', ['username', 'user_email', 'password']);
        $countryCode = request_country();
        $country = Country::find($countryCode);
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

            if ($country === null) {
                app('sentry')->getClient()->captureMessage(
                    'User registered from unknown country: '.$countryCode,
                    null,
                    (new Scope())
                        ->setExtra('country', $countryCode)
                        ->setExtra('ip', $ip)
                        ->setExtra('user_id', $registration->user()->getKey())
                );
            }

            return $registration->user()->fresh()->defaultJson();
        } catch (ValidationException $e) {
            return response(['form_error' => [
                'user' => $registration->user()->validationErrors()->all(),
            ]], 422);
        }
    }

    /**
     * Get User Beatmaps
     *
     * Returns the beatmaps of specified user.
     *
     * | Type                |
     * |---------------------|
     * | favourite           |
     * | graveyard           |
     * | loved               |
     * | most_played         |
     * | ranked_and_approved |
     * | unranked            |
     *
     * ---
     *
     * ### Response format
     *
     * Array of [Beatmapset](#beatmapset).
     *
     * @urlParam user required Id of the user. Example: 1
     * @urlParam type required Beatmap type. Example: favourite
     *
     * @queryParam limit Maximum number of results.
     * @queryParam offset Result offset for pagination. Example: 1
     *
     * @response [
     *   {
     *     "id": 1,
     *     "other": "attributes..."
     *   },
     *   {
     *     "id": 2,
     *     "other": "attributes..."
     *   }
     * ]
     */
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

    /**
     * Get Users
     *
     * Returns list of users.
     *
     * ---
     *
     * ### Response format
     *
     * Field | Type                          | Description
     * ----- | ----------------------------- | -----------
     * users | [UserCompact](#usercompact)[] | Includes: country, cover, groups, statistics_fruits, statistics_mania, statistics_osu, statistics_taiko.
     *
     * @queryParam ids[] User id to be returned. Specify once for each user id requested. Up to 50 users can be requested at once. Example: 1
     *
     * @response {
     *   "users": [
     *     {
     *       "id": 1,
     *       "other": "attributes..."
     *     },
     *     {
     *       "id": 2,
     *       "other": "attributes..."
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $params = get_params(request()->all(), null, ['ids:int[]']);

        $includes = UserCompactTransformer::CARD_INCLUDES;

        if (isset($params['ids'])) {
            $preload = UserCompactTransformer::CARD_INCLUDES_PRELOAD;

            foreach (Beatmap::MODES as $modeStr => $modeInt) {
                $includes[] = "statistics_rulesets.{$modeStr}";
                $preload[] = camel_case("statistics_{$modeStr}");
            }

            $users = User
                ::whereIn('user_id', array_slice($params['ids'], 0, 50))
                ->default()
                ->with($preload)
                ->get();
        }

        return [
            'users' => json_collection($users ?? [], 'UserCompact', $includes),
        ];
    }

    public function posts($id)
    {
        $user = User::lookup($id, 'id', true);
        if ($user === null || !priv_check('UserShow', $user)->can()) {
            abort(404);
        }

        $params = request()->all();
        $params['username'] = $id;
        $search = (new ForumSearch(new ForumSearchRequestParams($params)))->size(50);

        return ext_view('users.posts', compact('search', 'user'));
    }

    /**
     * Get User Kudosu
     *
     * Returns kudosu history.
     *
     * ---
     *
     * ### Response format
     *
     * Array of [KudosuHistory](#kudosuhistory).
     *
     * @urlParam user required Id of the user. Example: 1
     *
     * @queryParam limit Maximum number of results.
     * @queryParam offset Result offset for pagination. Example: 1
     *
     * @response [
     *   {
     *     "id": 1,
     *     "other": "attributes..."
     *   },
     *   {
     *     "id": 2,
     *     "other": "attributes..."
     *   }
     * ]
     */
    public function kudosu($_userId)
    {
        return $this->getExtra($this->user, 'recentlyReceivedKudosu', [], $this->perPage, $this->offset);
    }

    /**
     * Get User Recent Activity
     *
     * Returns recent activity.
     *
     * ---
     *
     * ### Response format
     *
     * Array of [Event](#event).
     *
     * @urlParam user required Id of the user. Example: 1
     *
     * @queryParam limit Maximum number of results.
     * @queryParam offset Result offset for pagination. Example: 1
     *
     * @response [
     *   {
     *     "id": 1,
     *     "other": "attributes..."
     *   },
     *   {
     *     "id": 2,
     *     "other": "attributes..."
     *   }
     * ]
     */
    public function recentActivity($_userId)
    {
        return $this->getExtra($this->user, 'recentActivity', [], $this->perPage, $this->offset);
    }

    /**
     * Get User Scores
     *
     * This endpoint returns the scores of specified user.
     *
     * ---
     *
     * ### Response format
     *
     * Array of [Score](#score).
     * Following attributes are included in the response object when applicable.
     *
     * Attribute  | Notes
     * -----------|----------------------
     * beatmap    | |
     * beatmapset | |
     * weight     | Only for type `best`.
     * user       | |
     *
     * @urlParam user required Id of the user. Example: 1
     * @urlParam type required Score type. Must be one of these: `best`, `firsts`, `recent`. Example: best
     *
     * @queryParam include_fails Only for recent scores, include scores of failed plays. Set to 1 to include them. Defaults to 0. Example: 0
     * @queryParam mode [GameMode](#gamemode) of the scores to be returned. Defaults to the specified `user`'s mode. Example: osu
     * @queryParam limit Maximum number of results.
     * @queryParam offset Result offset for pagination. Example: 1
     *
     * @response [
     *   {
     *     "id": 1,
     *     "other": "attributes..."
     *   },
     *   {
     *     "id": 2,
     *     "other": "attributes..."
     *   }
     * ]
     */
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

        $options = [
            'mode' => $this->mode,
            'includeFails' => get_bool(request('include_fails')) ?? false,
        ];

        $json = $this->getExtra($this->user, $page, $options, $perPage, $this->offset);

        return response($json, is_null($json['error'] ?? null) ? 200 : 504);
    }

    /**
     * Get Own Data
     *
     * Similar to [Get User](#get-user) but with authenticated user (token owner) as user id.
     *
     * ---
     *
     * ### Response format
     *
     * See [Get User](#get-user).
     *
     * @urlParam mode [GameMode](#gamemode). User default mode will be used if not specified. Example: osu
     *
     * @response "See User object section"
     */
    public function me($mode = null)
    {
        return static::show(auth()->user()->user_id, $mode);
    }

    /**
     * Get User
     *
     * This endpoint returns the detail of specified user.
     *
     * <aside class="notice">
     * It's highly recommended to pass <code>key</code> parameter to avoid getting unexpected result (mainly when looking up user with numeric username or nonexistent user id).
     * </aside>
     *
     * ---
     *
     * ### Response format
     *
     * Returns [User](#user) object.
     * Following attributes are included in the response object when applicable.
     *
     * Attribute                            | Notes
     * -------------------------------------|------
     * account_history                      | |
     * active_tournament_banner             | |
     * badges                               | |
     * beatmap_playcounts_count             | |
     * favourite_beatmapset_count           | |
     * follower_count                       | |
     * graveyard_beatmapset_count           | |
     * groups                               | |
     * loved_beatmapset_count               | |
     * monthly_playcounts                   | |
     * page                                 | |
     * previous_usernames                   | |
     * rank_history                         | For specified mode.
     * ranked_and_approved_beatmapset_count | |
     * replays_watched_counts               | |
     * scores_best_count                    | For specified mode.
     * scores_first_count                   | For specified mode.
     * scores_recent_count                  | For specified mode.
     * statistics                           | For specified mode. Inluces `rank` and `variants` attributes.
     * support_level                        | |
     * unranked_beatmapset_count            | |
     * user_achievements                    | |
     *
     * @urlParam user required Id or username of the user. Id lookup is prioritised unless `key` parameter is specified. Previous usernames are also checked in some cases. Example: 1
     * @urlParam mode [GameMode](#gamemode). User default mode will be used if not specified. Example: osu
     *
     * @queryParam key Type of `user` passed in url parameter. Can be either `id` or `username` to limit lookup by their respective type. Passing empty or invalid value will result in id lookup followed by username lookup if not found.
     *
     * @response "See User object section"
     */
    public function show($id, $mode = null)
    {
        $user = $this->lookupUser($id, get_string(request('key')));

        if ($user === null) {
            if (is_json_request()) {
                abort(404);
            }

            return ext_view('users.show_not_found', null, null, 404);
        }

        if (!is_api_request() && (string) $user->user_id !== (string) $id) {
            return ujs_redirect(route('users.show', compact('user', 'mode')));
        }

        $currentMode = $mode ?? $user->playmode;

        if (!Beatmap::isModeValid($currentMode)) {
            abort(404);
        }

        $userIncludes = [
            'account_history',
            'active_tournament_banner',
            'badges',
            'beatmap_playcounts_count',
            'favourite_beatmapset_count',
            'follower_count',
            'graveyard_beatmapset_count',
            'groups',
            'loved_beatmapset_count',
            'mapping_follower_count',
            'monthly_playcounts',
            'page',
            'previous_usernames',
            'rankHistory',
            'rank_history',
            'ranked_and_approved_beatmapset_count',
            'replays_watched_counts',
            'scores_best_count',
            'scores_first_count',
            'scores_recent_count',
            'statistics',
            'statistics.country_rank',
            'statistics.rank',
            'statistics.variants',
            'support_level',
            'unranked_beatmapset_count',
            'user_achievements',
        ];

        if (priv_check('UserSilenceShowExtendedInfo')->can() && !is_api_request()) {
            $userIncludes[] = 'account_history.actor';
            $userIncludes[] = 'account_history.supporting_url';
        }

        $transformer = new UserTransformer();
        $transformer->mode = $currentMode;
        $userArray = json_item(
            $user,
            $transformer,
            $userIncludes
        );

        if (is_api_request()) {
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

    // Find matching id or username
    // If no user is found, search for a previous username
    // only if parameter is not a number (assume number is an id lookup).
    private function lookupUser($id, ?string $type = null)
    {
        $user = User::lookupWithHistory($id, $type, true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            return null;
        }

        return $user;
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
                        ->with('post', 'post.topic', 'giver')
                        ->with(['kudosuable' => function (MorphTo $morphTo) {
                            $morphTo->morphWith([BeatmapDiscussion::class => ['beatmap', 'beatmapset']]);
                        }])
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
                        ->visibleUsers()
                        ->reorderBy('score_id', 'desc')
                        ->with('beatmap', 'beatmap.beatmapset', 'user');
                    break;
                case 'scoresRecent':
                    $transformer = 'Score';
                    $includes = ['beatmap', 'beatmapset', 'user'];
                    $query = $user->scores($options['mode'], true)
                        ->includeFails($options['includeFails'] ?? false)
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
