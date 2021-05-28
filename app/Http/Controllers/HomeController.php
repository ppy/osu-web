<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App;
use App\Libraries\CurrentStats;
use App\Libraries\Search\AllSearch;
use App\Libraries\Search\QuickSearch;
use App\Models\BeatmapDownload;
use App\Models\Beatmapset;
use App\Models\Forum\Post;
use App\Models\NewsPost;
use App\Models\UserDonation;
use Auth;
use Request;

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

        return parent::__construct();
    }

    public function bbcodePreview()
    {
        $post = new Post(['post_text' => Request::input('text')]);

        return $post->bodyHTML();
    }

    public function downloadQuotaCheck()
    {
        return [
            'quota_used' => BeatmapDownload::where('user_id', Auth::user()->user_id)->count(),
        ];
    }

    public function getDownload()
    {
        return ext_view('home.download');
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
            $newBeatmapsets = Beatmapset::latestRankedOrApproved();
            $popularBeatmapsets = Beatmapset::popular()->get();

            return ext_view('home.user', compact(
                'newBeatmapsets',
                'news',
                'popularBeatmapsets'
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

    public function osuSupportPopup()
    {
        return ext_view('objects._popup_support_osu');
    }

    public function quickSearch()
    {
        $quickSearch = new QuickSearch(request(), ['user' => auth()->user()]);
        $searches = $quickSearch->searches();

        $result = [];

        if ($quickSearch->hasQuery()) {
            foreach ($searches as $mode => $search) {
                if ($search === null) {
                    continue;
                }
                $result[$mode]['total'] = $search->count();
            }

            $result['user']['users'] = json_collection($searches['user']->data(), 'UserCompact', [
                'country',
                'cover',
                'groups',
                'support_level',
            ]);
            $result['beatmapset']['beatmapsets'] = json_collection($searches['beatmapset']->data(), 'Beatmapset', ['beatmaps']);
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
     * Field     | Type                          | Description
     * --------- | ----------------------------- | -----------
     * user      | SearchResult&lt;UserCompact>? | For `all` or `user` mode. Only first 100 results are accessible
     * wiki_page | SearchResult&lt;WikiPage>?    | For `all` or `wiki_page` mode
     *
     * #### SearchResult&lt;T>
     *
     * Field | Type   | Description
     * ----- | ------ | -----------
     * data  | T[]    | |
     * total | number | |
     *
     * @queryParam mode Either `all`, `user`, or `wiki_page`. Default is `all`. Example: all
     * @queryParam query Search keyword. Example: hello
     * @queryParam page Search result page. Ignored for mode `all`. Example: 1
     *
     * @group Home
     */
    public function search()
    {
        if (request('mode') === 'beatmapset') {
            return ujs_redirect(route('beatmapsets.index', ['q' => request('query')]));
        }

        $allSearch = new AllSearch(request(), ['user' => Auth::user()]);
        $isSearchPage = true;

        if (is_api_request()) {
            return response()->json($allSearch->toJson());
        }

        return ext_view('home.search', compact('allSearch', 'isSearchPage'));
    }

    public function setLocale()
    {
        $newLocale = get_valid_locale(Request::input('locale')) ?? config('app.fallback_locale');
        App::setLocale($newLocale);

        if (Auth::check()) {
            Auth::user()->update([
                'user_lang' => $newLocale,
            ]);
        }

        return ext_view('layout.ujs-reload', [], 'js')
            ->withCookie(cookie()->forever('locale', $newLocale));
    }

    public function supportTheGame()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // current status
            $expiration = optional($user->osu_subscriptionexpiry)->addDays(1);
            $current = $expiration !== null ? $expiration->isFuture() : false;

            // purchased
            $tagPurchases = $user->supporterTagPurchases;
            $dollars = $tagPurchases->sum('amount');
            $cancelledTags = $tagPurchases->where('cancel', true)->count() * 2; // 1 for purchase transaction and 1 for cancel transaction
            $tags = $tagPurchases->count() - $cancelledTags;

            // gifted
            $gifted = $tagPurchases->where('target_user_id', '<>', $user->user_id);
            $giftedDollars = $gifted->sum('amount');
            $canceledGifts = $gifted->where('cancel', true)->count() * 2; // 1 for purchase transaction and 1 for cancel transaction
            $giftedTags = $gifted->count() - $canceledGifts;

            $supporterStatus = [
                // current status
                'current' => $current,
                'expiration' => $expiration,
                // purchased
                'dollars' => currency($dollars, 2, false),
                'tags' => i18n_number_format($tags),
                // gifted
                'giftedDollars' => currency($giftedDollars, 2, false),
                'giftedTags' => i18n_number_format($giftedTags),
            ];

            if ($current) {
                $lastTagPurchaseDate = UserDonation::where('target_user_id', $user->user_id)
                    ->orderBy('timestamp', 'desc')
                    ->pluck('timestamp')
                    ->first();

                if ($lastTagPurchaseDate === null) {
                    $lastTagPurchaseDate = $expiration->copy()->subMonths(1);
                }

                $total = $expiration->diffInDays($lastTagPurchaseDate);
                $used = $lastTagPurchaseDate->diffInDays();

                $supporterStatus['remainingRatio'] = 100 - round($used / $total * 100, 2);
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
                                'base' => config('osu.beatmapset.upload_allowed'),
                                'bonus' => config('osu.beatmapset.upload_bonus_per_ranked'),
                                'bonus_max' => config('osu.beatmapset.upload_bonus_per_ranked_max'),
                                'supporter_base' => config('osu.beatmapset.upload_allowed_supporter'),
                                'supporter_bonus' => config('osu.beatmapset.upload_bonus_per_ranked_supporter'),
                                'supporter_bonus_max' => config('osu.beatmapset.upload_bonus_per_ranked_max_supporter'),
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
                                'normally' => config('osu.beatmapset.favourite_limit'),
                                'supporter' => config('osu.beatmapset.favourite_limit_supporter'),
                            ],
                        ],
                        'more_friends' => [
                            'icons' => ['fas fa-user-friends'],
                            'translation_options' => [
                                'normally' => config('osu.user.max_friends'),
                                'supporter' => config('osu.user.max_friends_supporter'),
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
