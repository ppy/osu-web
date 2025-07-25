<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App;
use App\Libraries\CurrentStats;
use App\Libraries\MenuContent;
use App\Libraries\Search\AllSearch;
use App\Libraries\Search\QuickSearch;
use App\Models\BeatmapDownload;
use App\Models\Beatmapset;
use App\Models\Forum\Post;
use App\Models\Multiplayer\Room;
use App\Models\NewsPost;
use App\Models\UserDonation;
use App\Transformers\MenuImageTransformer;
use Auth;
use Carbon\CarbonImmutable;
use Jenssegers\Agent\Agent;
use Request;

/**
 * @group Home
 */
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => [
                'downloadQuotaCheck',
                'quickSearch',
            ],
        ]);

        $this->middleware('require-scopes:public', ['only' => 'search']);

        parent::__construct();
    }

    public function bbcodePreview()
    {
        $post = new Post(['post_text' => Request::input('text')]);

        return $post->bodyHTML();
    }

    /**
     * @group Undocumented
     */
    public function downloadQuotaCheck()
    {
        return [
            'quota_used' => BeatmapDownload::where('user_id', Auth::user()->user_id)->count(),
        ];
    }

    public function getDownload()
    {
        $lazerPlatformNames = [
            'android' => osu_trans('home.download.os_version_or_later', ['os_version' => 'Android 5']),
            'ios' => osu_trans('home.download.os_version_or_later', ['os_version' => 'iOS 13.4']),
            'linux_x64' => 'Linux (x64)',
            'macos_as' => osu_trans('home.download.os_version_or_later', ['os_version' => 'macOS 10.15']).' (Apple Silicon)',
            'windows_x64' => osu_trans('home.download.os_version_or_later', ['os_version' => 'Windows 8.1']).' (x64)',
        ];

        $agent = new Agent(Request::server());

        $platform = match (true) {
            // Try matching most likely platform first
            $agent->is('Windows') => 'windows_x64',
            // iPadOS detection apparently doesn't work on newer version
            // and detected as macOS instead.
            ($agent->isiOS() || $agent->isiPadOS()) => $platform = 'ios',
            // FIXME: Figure out a way to differentiate Intel and Apple Silicon.
            $agent->is('OS X') => 'macos_as',
            $agent->isAndroidOS() => 'android',
            $agent->is('Linux') => 'linux_x64',
            default => 'windows_x64',
        };

        return ext_view('home.download', [
            'lazerUrl' => osu_url("lazer_dl.{$platform}"),
            'lazerPlatformName' => $lazerPlatformNames[$platform],
        ]);
    }

    public function index()
    {
        $host = Request::getHttpHost();
        $subdomain = substr($host, 0, strpos($host, '.'));

        if ($subdomain === 'store') {
            return ujs_redirect(route('store.products.index'));
        }

        $newsLimit = Auth::check() ? NewsPost::DASHBOARD_LIMIT + 1 : NewsPost::LANDING_LIMIT;
        $news = NewsPost::default()->limit($newsLimit)->get();

        if (Auth::check()) {
            $menuImages = json_collection(MenuContent::activeImages(), new MenuImageTransformer());
            $newBeatmapsets = Beatmapset::latestRanked();
            $popularBeatmapsets = Beatmapset::popular()->get();

            $dailyChallenge = Room::dailyChallengeFor(CarbonImmutable::now());

            return ext_view('home.user', compact(
                'menuImages',
                'newBeatmapsets',
                'news',
                'popularBeatmapsets',
                'dailyChallenge',
            ));
        } else {
            $news = json_collection($news, 'NewsPost');

            return ext_view('home.landing', ['stats' => new CurrentStats(), 'news' => $news]);
        }
    }

    public function messageUser($user)
    {
        return ujs_redirect(route('chat.index', ['sendto' => $user]));
    }

    public function opensearch()
    {
        return ext_view('home.opensearch', null, 'opensearch')->header('Cache-Control', 'max-age=86400');
    }

    public function quickSearch()
    {
        $quickSearch = new QuickSearch(Request::all(), ['user' => auth()->user()]);
        $searches = $quickSearch->searches();

        $result = [];

        if ($quickSearch->hasQuery()) {
            foreach ($searches as $mode => $search) {
                if ($search === null) {
                    continue;
                }
                $result[$mode]['total'] = $search->count();
                if (QuickSearch::MODES[$mode]['size'] !== 0) {
                    $transformer = QuickSearch::MODES[$mode]['transformer'];
                    $result[$mode]['items'] = json_collection(
                        $search->data(),
                        new $transformer['class'](),
                        $transformer['includes'],
                    );
                }
            }
        }

        return $result;
    }

    /**
     * Search
     *
     * Searches users and wiki pages.
     *
     * ---
     *
     * ### Response Format
     *
     * Field     | Type                       | Description
     * --------- | -------------------------- | -----------
     * user      | SearchResult&lt;User>?     | For `all` or `user` mode. Only first 100 results are accessible
     * wiki_page | SearchResult&lt;WikiPage>? | For `all` or `wiki_page` mode
     *
     * #### SearchResult&lt;T>
     *
     * Field | Type    | Description
     * ----- | ------- | -----------
     * data  | T[]     | |
     * total | integer | |
     *
     * @queryParam mode string Either `all`, `user`, or `wiki_page`. Default is `all`. Example: all
     * @queryParam query Search keyword. Example: hello
     * @queryParam page Search result page. Ignored for mode `all`. Example: 1
     */
    public function search()
    {
        $currentUser = Auth::user();
        $allSearch = new AllSearch(Request::all(), ['user' => $currentUser]);

        switch ($allSearch->getMode()) {
            case 'artist_track':
                return ujs_redirect(route('artists.tracks.index', ['query' => $allSearch->getRawQuery()]));
            case 'beatmapset':
                return ujs_redirect(route('beatmapsets.index', ['q' => $allSearch->getRawQuery()]));
        }

        $isSearchPage = true;

        if (is_api_request()) {
            return response()->json($allSearch->toJson());
        }

        $fields = $currentUser?->isModerator() ?? false ? [] : ['includeDeleted' => null];

        return ext_view('home.search', compact('allSearch', 'fields', 'isSearchPage'));
    }

    public function setLocale()
    {
        $newLocale = get_valid_locale(Request::input('locale')) ?? $GLOBALS['cfg']['app']['fallback_locale'];
        App::setLocale($newLocale);

        if (Auth::check()) {
            Auth::user()->update([
                'user_lang' => $newLocale,
            ]);
        }

        return ext_view('layout.ujs_full_reload', [], 'js')
            ->withCookie(cookie()->forever('locale', $newLocale));
    }

    public function supportTheGame()
    {
        $user = auth()->user();

        if ($user !== null) {
            // current status
            $expiration = $user->osu_subscriptionexpiry?->addDays(1);
            $current = $expiration?->isFuture() ?? false;

            static $lengthSumFn = fn ($p) => $p['length'] * ($p['cancel'] ? -1 : 1);
            // purchased
            $tagPurchases = $user->supporterTagPurchases;
            $dollars = $tagPurchases->sum('amount');
            $duration = $tagPurchases->sum($lengthSumFn);

            // gifted
            $gifted = $tagPurchases->where('target_user_id', '<>', $user->user_id);
            $giftedDollars = $gifted->sum('amount');
            $giftedDuration = $gifted->sum($lengthSumFn);

            $giftedUsers = [];
            foreach ($gifted as $gift) {
                $giftedUsers[$gift->target_user_id] =
                    ($giftedUsers[$gift->target_user_id] ?? 0)
                    + ($gift->cancel ? -1 : 1);
            }
            $giftedUsers = count(array_filter($giftedUsers, fn ($count) => $count > 0));

            $supporterStatus = [
                // current status
                'current' => $current,
                'expiration' => $expiration,
                // purchased
                'dollars' => currency($dollars, 2, false),
                'duration' => $duration,
                // gifted
                'giftedDollars' => currency($giftedDollars, 2, false),
                'giftedDuration' => $giftedDuration,
                'giftedUsers' => $giftedUsers,
            ];

            if ($current) {
                $lastTagPurchaseDate = UserDonation::where('target_user_id', $user->user_id)
                    ->orderBy('timestamp', 'desc')
                    ->pluck('timestamp')
                    ->first();

                $lastTagPurchaseDate ??= $expiration->copy()->subMonths(1);

                $total = max(1, $lastTagPurchaseDate->diffInDays($expiration));
                $used = max(1, $lastTagPurchaseDate->diffInDays());

                $supporterStatus['remainingPercent'] = 100 - round($used / $total * 100, 2);
            }
        }

        $pageLayout = [
            // why support
            'support-reasons' => [
                'type' => 'group',
                'section' => 'why-support',
                'items' => [
                    'team' => [
                        'icons' => ['fas fa-users'],
                    ],
                    'infra' => [
                        'icons' => ['fas fa-server'],
                    ],
                    'featured-artists' => [
                        'icons' => ['fas fa-user-astronaut'],
                        'link' => route('artists.index'),
                    ],
                    'ads' => [
                        'icons' => ['fas fa-ad', 'fas fa-slash'],
                    ],
                    'tournaments' => [
                        'icons' => ['fas fa-trophy'],
                        'link' => route('tournaments.index'),
                    ],
                    'bounty-program' => [
                        'icons' => ['fas fa-child'],
                        'link' => osu_url('bounty-form'),
                    ],
                ],
            ],

            // supporter perks

            // There are 5 perk rendering types: image, image-flipped, hero, group and image-group.
            // image, image-flipped, hero each show an individual perk (with image) while group and image-group show groups of perks (the latter with images)
            'perks' => [
                [
                    'type' => 'image',
                    'name' => 'osu_direct',
                    'icons' => ['fas fa-search'],
                ],
                [
                    'type' => 'image_group',
                    'items' => [
                        'friend_ranking' => [
                            'icons' => ['fas fa-list-alt'],
                        ],
                        'country_ranking' => [
                            'icons' => ['fas fa-globe-asia'],
                        ],
                        'mod_filtering' => [
                            'icons' => ['fas fa-tasks'],
                        ],
                    ],
                ],
                [
                    'type' => 'image',
                    'variant' => 'flipped',
                    'name' => 'beatmap_filters',
                    'icons' => ['fas fa-filter'],
                ],
                [
                    'type' => 'group',
                    'items' => [
                        'auto_downloads' => [
                            'icons' => ['fas fa-download'],
                        ],
                        'more_beatmaps' => [
                            'icons' => ['fas fa-file-upload'],
                            'translation_options' => [
                                'base' => $GLOBALS['cfg']['osu']['beatmapset']['upload_allowed'],
                                'bonus' => $GLOBALS['cfg']['osu']['beatmapset']['upload_bonus_per_ranked'],
                                'bonus_max' => $GLOBALS['cfg']['osu']['beatmapset']['upload_bonus_per_ranked_max'],
                                'supporter_base' => $GLOBALS['cfg']['osu']['beatmapset']['upload_allowed_supporter'],
                                'supporter_bonus' => $GLOBALS['cfg']['osu']['beatmapset']['upload_bonus_per_ranked_supporter'],
                                'supporter_bonus_max' => $GLOBALS['cfg']['osu']['beatmapset']['upload_bonus_per_ranked_max_supporter'],
                            ],
                        ],
                        'early_access' => [
                            'icons' => ['fas fa-flask'],
                        ],
                    ],
                ],
                [
                    'type' => 'hero',
                    'name' => 'customisation',
                    'icons' => ['fas fa-image'],
                ],
                [
                    'type' => 'group',
                    'items' => [
                        'more_favourites' => [
                            'icons' => ['fas fa-star'],
                            'translation_options' => [
                                'normally' => $GLOBALS['cfg']['osu']['beatmapset']['favourite_limit'],
                                'supporter' => $GLOBALS['cfg']['osu']['beatmapset']['favourite_limit_supporter'],
                            ],
                        ],
                        'more_friends' => [
                            'icons' => ['fas fa-user-friends'],
                            'translation_options' => [
                                'normally' => $GLOBALS['cfg']['osu']['user']['max_friends'],
                                'supporter' => $GLOBALS['cfg']['osu']['user']['max_friends_supporter'],
                            ],
                        ],
                        'friend_filtering' => [
                            'icons' => ['fas fa-medal'],
                        ],
                    ],
                ],
                [
                    'type' => 'image_group',
                    'items' => [
                        'yellow_fellow' => [
                            'icons' => ['fas fa-fire'],
                        ],
                        'speedy_downloads' => [
                            'icons' => ['fas fa-tachometer-alt'],
                        ],
                        'change_username' => [
                            'icons' => ['fas fa-magic'],
                        ],
                        'skinnables' => [
                            'icons' => ['fas fa-paint-brush'],
                        ],
                    ],
                ],
            ],
        ];

        return ext_view('home.support-the-game', [
            'supporterStatus' => $supporterStatus ?? [],
            'data' => $pageLayout,
        ]);
    }

    public function testflight()
    {
        return ext_view('home.testflight');
    }
}
