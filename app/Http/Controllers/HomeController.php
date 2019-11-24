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
use View;

class HomeController extends Controller
{
    protected $section = 'home';

    public function __construct()
    {
        $this->middleware('auth', [
            'only' => [
                'downloadQuotaCheck',
                'quickSearch',
                'search',
            ],
        ]);

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
        return view('home.download');
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
            $popularBeatmapsets = Beatmapset::ranked()
                ->where('approved_date', '>', now()->subDays(30))
                ->orderBy('favourite_count', 'DESC')
                ->limit(5)
                ->get();

            return view('home.user', compact(
                'newBeatmapsets',
                'news',
                'popularBeatmapsets'
            ));
        } else {
            $news = json_collection($news, 'NewsPost');

            return view('home.landing', ['stats' => new CurrentStats(), 'news' => $news]);
        }
    }

    public function messageUser($user)
    {
        return ujs_redirect(route('chat.index', ['sendto' => $user]));
    }

    public function osuSupportPopup()
    {
        return view('objects._popup_support_osu');
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
                'group_badge',
                'support_level',
            ]);
            $result['beatmapset']['beatmapsets'] = json_collection($searches['beatmapset']->data(), 'Beatmapset', ['beatmaps']);
        }

        return $result;
    }

    public function search()
    {
        if (request('mode') === 'beatmapset') {
            return ujs_redirect(route('beatmapsets.index', ['q' => request('query')]));
        }

        $allSearch = new AllSearch(request(), ['user' => Auth::user()]);
        $isSearchPage = true;

        return view('home.search', compact('allSearch', 'isSearchPage'));
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

        return js_view('layout.ujs-reload')
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

                $supporterStatus['remainingRatio'] = 100 - round(($used / $total) * 100, 2);
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

        return view('home.support-the-game')
            ->with('supporterStatus', $supporterStatus ?? [])
            ->with('data', $pageLayout);
    }
}
