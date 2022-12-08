<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\UserProfilePageLookupException;
use App\Exceptions\ValidationException;
use App\Http\Middleware\RequestCost;
use App\Libraries\RateLimiter;
use App\Libraries\Search\ForumSearch;
use App\Libraries\Search\ForumSearchRequestParams;
use App\Libraries\User\FindForProfilePage;
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
use App\Transformers\CurrentUserTransformer;
use App\Transformers\ScoreTransformer;
use App\Transformers\UserCompactTransformer;
use App\Transformers\UserMonthlyPlaycountTransformer;
use App\Transformers\UserReplaysWatchedCountTransformer;
use App\Transformers\UserTransformer;
use Auth;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Request;
use Sentry\State\Scope;

/**
 * @group Users
 */
class UsersController extends Controller
{
    // more limited list of UserProfileCustomization::SECTIONS for now.
    const LAZY_EXTRA_PAGES = ['beatmaps', 'kudosu', 'recent_activity', 'top_ranks', 'historical'];

    const PER_PAGE = [
        'scoresBest' => 5,
        'scoresFirsts' => 5,
        'scoresPinned' => 5,
        'scoresRecent' => 5,

        'beatmapPlaycounts' => 5,
        'favouriteBeatmapsets' => 6,
        'graveyardBeatmapsets' => 2,
        'guestBeatmapsets' => 6,
        'lovedBeatmapsets' => 6,
        'nominatedBeatmapsets' => 6,
        'pendingBeatmapsets' => 6,
        'rankedBeatmapsets' => 6,

        'recentActivity' => 5,
        'recentlyReceivedKudosu' => 5,
    ];

    protected $maxResults = 100;

    private ?string $mode = null;
    private ?int $offset = null;
    private ?int $perPage = null;
    private ?User $user = null;

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
            'index',
            'kudosu',
            'recentActivity',
            'scores',
            'show',
        ]]);

        $this->middleware(function ($request, $next) {
            $this->parsePaginationParams();

            return $next($request);
        }, [
            'only' => ['extraPages', 'scores', 'beatmapsets', 'kudosu', 'recentActivity'],
        ]);

        parent::__construct();
    }

    public function card($id)
    {
        try {
            $user = FindForProfilePage::find($id, null, false);
        } catch (UserProfilePageLookupException $e) {
            $user = UserNotFound::instance();
        }

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
        $username = get_string(request('username'));
        $user = User::lookup($username, 'username') ?? UserNotFound::instance();

        return json_item($user, 'UserCompact', ['cover', 'country']);
    }

    public function extraPages($_id, $page)
    {
        // TODO: counts basically duplicated from UserCompactTransformer
        switch ($page) {
            case 'beatmaps':
                return [
                    'favourite' => $this->getExtraSection('favouriteBeatmapsets', $this->user->profileBeatmapsetsFavourite()->count()),
                    'graveyard' => $this->getExtraSection('graveyardBeatmapsets', $this->user->profileBeatmapsetCountByGroupedStatus('graveyard')),
                    'guest' => $this->getExtraSection('guestBeatmapsets', $this->user->profileBeatmapsetsGuest()->count()),
                    'loved' => $this->getExtraSection('lovedBeatmapsets', $this->user->profileBeatmapsetCountByGroupedStatus('loved')),
                    'nominated' => $this->getExtraSection('nominatedBeatmapsets', $this->user->profileBeatmapsetsNominated()->count()),
                    'ranked' => $this->getExtraSection('rankedBeatmapsets', $this->user->profileBeatmapsetCountByGroupedStatus('ranked')),
                    'pending' => $this->getExtraSection('pendingBeatmapsets', $this->user->profileBeatmapsetCountByGroupedStatus('pending')),
                ];

            case 'historical':
                return [
                    'beatmap_playcounts' => $this->getExtraSection('beatmapPlaycounts', $this->user->beatmapPlaycounts()->count()),
                    'monthly_playcounts' => json_collection($this->user->monthlyPlaycounts, new UserMonthlyPlaycountTransformer()),
                    'recent' => $this->getExtraSection(
                        'scoresRecent',
                        $this->user->scores($this->mode, true)->includeFails(false)->count()
                    ),
                    'replays_watched_counts' => json_collection($this->user->replaysWatchedCounts, new UserReplaysWatchedCountTransformer()),
                ];

            case 'kudosu':
                return $this->getExtraSection('recentlyReceivedKudosu');

            case 'recent_activity':
                return $this->getExtraSection('recentActivity');

            case 'top_ranks':
                return [
                    'best' => $this->getExtraSection(
                        'scoresBest',
                        count($this->user->beatmapBestScoreIds($this->mode))
                    ),
                    'firsts' => $this->getExtraSection(
                        'scoresFirsts',
                        $this->user->scoresFirst($this->mode, true)->visibleUsers()->count()
                    ),
                    'pinned' => $this->getExtraSection(
                        'scoresPinned',
                        $this->user->scorePins()->forRuleset($this->mode)->withVisibleScore()->count()
                    ),
                ];

            default:
                abort(404);
        }
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

            return json_item($registration->user()->fresh(), new CurrentUserTransformer());
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
     * | Type        | Notes
     * |------------ | -----
     * | favourite   | |
     * | graveyard   | |
     * | loved       | |
     * | most_played | |
     * | pending     | Previously `unranked`
     * | ranked      | Previously `ranked_and_approved`
     *
     * ---
     *
     * ### Response format
     *
     * Array of [BeatmapPlaycount](#beatmapplaycount) when `type` is `most_played`;
     * array of [Beatmapset](#beatmapset), otherwise.
     *
     * @urlParam user integer required Id of the user. Example: 1
     * @urlParam type string required Beatmap type. Example: favourite
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
            'guest' => 'guestBeatmapsets',
            'loved' => 'lovedBeatmapsets',
            'most_played' => 'beatmapPlaycounts',
            'nominated' => 'nominatedBeatmapsets',
            'ranked' => 'rankedBeatmapsets',
            'pending' => 'pendingBeatmapsets',

            // TODO: deprecated
            'ranked_and_approved' => 'rankedBeatmapsets',
            'unranked' => 'pendingBeatmapsets',
        ];

        $page = $mapping[$type] ?? abort(404);

        // Override per page restriction in parsePaginationParams to allow infinite paging
        $perPage = $this->sanitizedLimitParam();

        return $this->getExtra($page, [], $perPage, $this->offset);
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
     * users | [UserCompact](#usercompact)[] | Includes: country, cover, groups, statistics_rulesets.
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
            RequestCost::setCost(count($params['ids']));
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
     * @urlParam user integer required Id of the user. Example: 1
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
        return $this->getExtra('recentlyReceivedKudosu', [], $this->perPage, $this->offset);
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
     * @urlParam user integer required Id of the user. Example: 1
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
        return $this->getExtra('recentActivity', [], $this->perPage, $this->offset);
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
     *
     * @urlParam user integer required Id of the user. Example: 1
     * @urlParam type string required Score type. Must be one of these: `best`, `firsts`, `recent`. Example: best
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
            'pinned' => 'scoresPinned',
            'recent' => 'scoresRecent',
        ];

        $page = $mapping[$type] ?? abort(404);

        $perPage = $this->perPage;

        if ($type === 'firsts' || $type === 'pinned') {
            // Override per page restriction in parsePaginationParams to allow infinite paging
            $perPage = $this->sanitizedLimitParam();
        }

        $options = [
            'includeFails' => get_bool(request('include_fails')) ?? false,
        ];

        $json = $this->getExtra($page, $options, $perPage, $this->offset);

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
     * Additionally, `statistics_rulesets` is included, containing statistics for all rulesets.
     *
     * @urlParam mode string [GameMode](#gamemode). User default mode will be used if not specified. Example: osu
     *
     * @response "See User object section"
     */
    public function me($mode = null)
    {
        $user = auth()->user();
        $currentMode = $mode ?? $user->playmode;

        if (!Beatmap::isModeValid($currentMode)) {
            abort(404);
        }

        return $this->fillDeprecatedDuplicateFields(json_item(
            $user,
            (new UserTransformer())->setMode($currentMode),
            [
                ...$this->showUserIncludes(),
                ...array_map(
                    fn (string $ruleset) => "statistics_rulesets.{$ruleset}",
                    array_keys(Beatmap::MODES),
                ),
            ],
        ));
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
     * The following [optional attributes on UserCompact](#usercompact-optionalattributes) are included:
     *
     * - account_history
     * - active_tournament_banner
     * - badges
     * - beatmap_playcounts_count
     * - favourite_beatmapset_count
     * - follower_count
     * - graveyard_beatmapset_count
     * - groups
     * - loved_beatmapset_count
     * - mapping_follower_count
     * - monthly_playcounts
     * - page
     * - pending_beatmapset_count
     * - previous_usernames
     * - rank_highest
     * - rank_history
     * - ranked_beatmapset_count
     * - replays_watched_counts
     * - scores_best_count
     * - scores_first_count
     * - scores_recent_count
     * - statistics
     * - statistics.country_rank
     * - statistics.rank
     * - statistics.variants
     * - support_level
     * - user_achievements
     *
     * @urlParam user integer required Id or username of the user. Id lookup is prioritised unless `key` parameter is specified. Previous usernames are also checked in some cases. Example: 1
     * @urlParam mode string [GameMode](#gamemode). User default mode will be used if not specified. Example: osu
     *
     * @queryParam key Type of `user` passed in url parameter. Can be either `id` or `username` to limit lookup by their respective type. Passing empty or invalid value will result in id lookup followed by username lookup if not found.
     *
     * @response "See User object section"
     */
    public function show($id, $mode = null)
    {
        $user = FindForProfilePage::find($id, get_string(request('key')));

        $currentMode = $mode ?? $user->playmode;

        if (!Beatmap::isModeValid($currentMode)) {
            abort(404);
        }

        $userArray = $this->fillDeprecatedDuplicateFields(json_item(
            $user,
            (new UserTransformer())->setMode($currentMode),
            $this->showUserIncludes(),
        ));

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

            $extras = [];

            $initialData = [
                'achievements' => $achievements,
                'current_mode' => $currentMode,
                'scores_notice' => config('osu.user.profile_scores_notice'),
                'user' => $userArray,
            ];

            // moved data
            // TODO: lazy load
            $this->parsePaginationParams();
            foreach (static::LAZY_EXTRA_PAGES as $page) {
                $initialData[$page] = $this->extraPages($id, $page);
            }

            return ext_view('users.show', compact('initialData', 'user'));
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

            return ['html' => $user->userPage->bodyHTML(['modifiers' => ['profile-page']])];
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }
    }

    private function parsePaginationParams()
    {
        $this->user = FindForProfilePage::find(request()->route('user'), 'id');

        $this->mode = request()->route('mode') ?? request()->input('mode') ?? $this->user->playmode;
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
        return clamp(get_int(request('limit')) ?? 5, 1, 100);
    }

    private function getExtra($page, array $options, int $perPage = 10, int $offset = 0)
    {
        // Grouped by $transformer and sorted alphabetically ($transformer and then $page).
        switch ($page) {
            // BeatmapPlaycount
            case 'beatmapPlaycounts':
                $transformer = 'BeatmapPlaycount';
                $query = $this->user->beatmapPlaycounts()
                    ->with('beatmap', 'beatmap.beatmapset')
                    ->whereHas('beatmap.beatmapset')
                    ->orderBy('playcount', 'desc')
                    ->orderBy('beatmap_id', 'desc'); // for consistent sorting
                break;

            // Beatmapset
            case 'favouriteBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsFavourite();
                break;
            case 'graveyardBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsGraveyard()
                    ->orderBy('last_update', 'desc');
                break;
            case 'guestBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsGuest()
                    ->orderBy('approved_date', 'desc');
                break;
            case 'lovedBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsLoved()
                    ->orderBy('approved_date', 'desc');
                break;
            case 'nominatedBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsNominated()
                    ->orderBy('approved_date', 'desc');
                break;
            case 'rankedBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsRanked()
                    ->orderBy('approved_date', 'desc');
                break;
            case 'pendingBeatmapsets':
                $transformer = 'Beatmapset';
                $includes = ['beatmaps'];
                $query = $this->user->profileBeatmapsetsPending()
                    ->orderBy('last_update', 'desc');
                break;

            // Event
            case 'recentActivity':
                $transformer = 'Event';
                $query = $this->user->events()->recent();
                break;

            // KudosuHistory
            case 'recentlyReceivedKudosu':
                $transformer = 'KudosuHistory';
                $query = $this->user->receivedKudosu()
                    ->with('post', 'post.topic', 'giver')
                    ->with(['kudosuable' => function (MorphTo $morphTo) {
                        $morphTo->morphWith([BeatmapDiscussion::class => ['beatmap', 'beatmapset']]);
                    }])
                    ->orderBy('exchange_id', 'desc');
                break;

            // Score
            case 'scoresBest':
                $transformer = new ScoreTransformer();
                $includes = [...ScoreTransformer::USER_PROFILE_INCLUDES, 'weight'];
                $collection = $this->user->beatmapBestScores($this->mode, $perPage, $offset, ScoreTransformer::USER_PROFILE_INCLUDES_PRELOAD);
                $userRelationColumn = 'user';
                break;
            case 'scoresFirsts':
                $transformer = new ScoreTransformer();
                $includes = ScoreTransformer::USER_PROFILE_INCLUDES;
                $query = $this->user->scoresFirst($this->mode, true)
                    ->visibleUsers()
                    ->reorderBy('score_id', 'desc')
                    ->with(ScoreTransformer::USER_PROFILE_INCLUDES_PRELOAD);
                $userRelationColumn = 'user';
                break;
            case 'scoresPinned':
                $transformer = new ScoreTransformer();
                $includes = ScoreTransformer::USER_PROFILE_INCLUDES;
                $query = $this->user
                    ->scorePins()
                    ->forRuleset($this->mode)
                    ->withVisibleScore()
                    ->with(array_map(fn ($include) => "score.{$include}", ScoreTransformer::USER_PROFILE_INCLUDES_PRELOAD))
                    ->reorderBy('display_order', 'asc');
                $collectionFn = fn ($pins) => $pins->map->score;
                $userRelationColumn = 'user';
                break;
            case 'scoresRecent':
                $transformer = new ScoreTransformer();
                $includes = ScoreTransformer::USER_PROFILE_INCLUDES;
                $query = $this->user->scores($this->mode, true)
                    ->includeFails($options['includeFails'] ?? false)
                    ->with([...ScoreTransformer::USER_PROFILE_INCLUDES_PRELOAD, 'best']);
                $userRelationColumn = 'user';
                break;
        }

        if (!isset($collection)) {
            $collection = $query->limit($perPage)->offset($offset)->get();

            if (isset($collectionFn)) {
                $collection = $collectionFn($collection);
            }
        }

        if (isset($userRelationColumn)) {
            foreach ($collection as $item) {
                $item->setRelation($userRelationColumn, $this->user);
            }
        }

        return json_collection($collection, $transformer, $includes ?? []);
    }

    private function getExtraSection(string $section, ?int $count = null)
    {
        // TODO: replace with cursor.
        $items = $this->getExtra($section, [], static::PER_PAGE[$section] + 1);
        $hasMore = count($items) > static::PER_PAGE[$section];
        if ($hasMore) {
            array_pop($items);
        }

        $response = [
            'items' => $items,
            'pagination' => [
                'hasMore' => $hasMore,
            ],
        ];

        if ($count !== null) {
            $response['count'] = $count;
        }

        return $response;
    }

    private function showUserIncludes()
    {
        static $apiIncludes = [
            // historical
            'beatmap_playcounts_count',
            'monthly_playcounts',
            'replays_watched_counts',
            'scores_recent_count',

            // beatmapsets
            'favourite_beatmapset_count',
            'graveyard_beatmapset_count',
            'guest_beatmapset_count',
            'loved_beatmapset_count',
            'nominated_beatmapset_count',
            'pending_beatmapset_count',
            'ranked_beatmapset_count',

            // top scores
            'scores_best_count',
            'scores_first_count',
            'scores_pinned_count',
        ];

        $userIncludes = [
            ...UserTransformer::PROFILE_HEADER_INCLUDES,
            'account_history',
            'page',
            'pending_beatmapset_count',
            'rank_highest',
            'rank_history',
            'statistics',
            'statistics.country_rank',
            'statistics.rank',
            'statistics.variants',
            'user_achievements',
        ];

        if (is_api_request()) {
            // TODO: deprecate
            $userIncludes = array_merge($userIncludes, $apiIncludes);
        }

        if (priv_check('UserSilenceShowExtendedInfo')->can() && !is_api_request()) {
            $userIncludes[] = 'account_history.actor';
            $userIncludes[] = 'account_history.supporting_url';
        }

        return $userIncludes;
    }

    private function fillDeprecatedDuplicateFields(array $userJson): array
    {
        static $map = [
            'rankHistory' => 'rank_history',
            'ranked_and_approved_beatmapset_count' => 'ranked_beatmapset_count',
            'unranked_beatmapset_count' => 'pending_beatmapset_count',
        ];

        foreach ($map as $legacyKey => $key) {
            if (array_key_exists($key, $userJson)) {
                $userJson[$legacyKey] = $userJson[$key];
            }
        }

        return $userJson;
    }
}
