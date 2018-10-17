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

use App;
use App\Libraries\CurrentStats;
use App\Libraries\Search\AllSearch;
use App\Models\BeatmapDownload;
use App\Models\Beatmapset;
use App\Models\Forum\Post;
use App\Models\NewsPost;
use App\Models\User;
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
                'search',
            ],
        ]);

        return parent::__construct();
    }

    public function bbcodePreview()
    {
        $post = new Post(['post_text' => Request::input('text')]);

        return $post->bodyHTML;
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

    public function getIcons()
    {
        return view('home.icons')
        ->with('icons', [
            'osu',
            'mode-osu',
            'mode-mania',
            'mode-fruits',
            'mode-taiko',
            'social-patreon',
        ]);
    }

    public function index()
    {
        $host = Request::getHttpHost();
        $subdomain = substr($host, 0, strpos($host, '.'));

        if ($subdomain === 'store') {
            return ujs_redirect(route('store.products.index'));
        }

        if (Auth::check()) {
            $news = NewsPost::default()->limit(NewsPost::DASHBOARD_LIMIT + 1)->get();
            $newBeatmapsets = Beatmapset::latestRankedOrApproved();
            $popularBeatmapsetsPlaycount = Beatmapset::mostPlayedToday();
            $popularBeatmapsetIds = array_keys($popularBeatmapsetsPlaycount);
            $popularBeatmapsets = Beatmapset::whereIn('beatmapset_id', $popularBeatmapsetIds)
                ->orderByField('beatmapset_id', $popularBeatmapsetIds)
                ->get();

            return view('home.user', compact(
                'newBeatmapsets',
                'news',
                'popularBeatmapsets',
                'popularBeatmapsetsPlaycount'
            ));
        } else {
            return view('home.landing', ['stats' => new CurrentStats()]);
        }
    }

    public function messageUser($user)
    {
        return ujs_redirect("https://osu.ppy.sh/forum/ucp.php?i=pm&mode=compose&u={$user}");
    }

    public function osuSupportPopup()
    {
        return view('objects._popup_support_osu');
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
        $newLocale = get_valid_locale(Request::input('locale'));
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
                'tags' => number_format($tags),
                // gifted
                'giftedDollars' => currency($giftedDollars, 2, false),
                'giftedTags' => number_format($giftedTags),
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

        return view('home.support-the-game')
            ->with('supporterStatus', $supporterStatus ?? [])
            ->with('data', [
                // why support's blocks
                'blocks' => [
                    // localization's name => icon
                    'dev' => 'fas fa-user',
                    'time' => 'far fa-clock',
                    'ads' => 'fas fa-thumbs-up',
                    'goodies' => 'fas fa-star',
                ],

                // supporter's perks
                'perks' => [
                    // localization's name => icon
                    'osu_direct' => 'fas fa-search',
                    'auto_downloads' => 'fas fa-download',
                    'upload_more' => 'fas fa-cloud-upload-alt',
                    'early_access' => 'fas fa-flask',
                    'customisation' => 'far fa-image',
                    'beatmap_filters' => 'fas fa-filter',
                    'yellow_fellow' => 'fas fa-fire',
                    'speedy_downloads' => 'fas fa-tachometer-alt',
                    'change_username' => 'fas fa-magic',
                    'skinnables' => 'fas fa-paint-brush',
                    'feature_votes' => 'fas fa-thumbs-up',
                    'sort_options' => 'fas fa-trophy',
                    'feel_special' => 'fas fa-heart',
                    'more_to_come' => 'fas fa-gift',
                ],
            ]);
    }
}
