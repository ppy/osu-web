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
use App\Models\BanchoStats;
use App\Models\Beatmapset;
use App\Models\Count;
use App\Models\Forum\Post;
use App\Models\News;
use Auth;
use Request;
use View;

class HomeController extends Controller
{
    protected $section = 'home';

    public function bbcodePreview()
    {
        $post = new Post(['post_text' => Request::input('text')]);

        return $post->bodyHTML;
    }

    public function getChangelog()
    {
        return view('home.changelog');
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

        $stats = BanchoStats::cachedStats();
        $totalUsers = number_format(Count::cachedTotalUsers());
        $graphData = array_to_graph_json($stats, 'users_osu');

        $latest = array_last($stats);
        if ($latest) {
            $currentOnline = number_format($latest['users_osu']);
            $currentGames = number_format($latest['multiplayer_games']);
        } else {
            $currentOnline = $currentGames = 0;
        }

        if (Auth::check()) {
            $news = News::all();
            $newBeatmaps = Beatmapset::latestRankedOrApproved();
            $popularBeatmapsPlaycount = Beatmapset::mostPlayedToday();
            $popularBeatmaps = Beatmapset::whereIn('beatmapset_id', array_keys($popularBeatmapsPlaycount))->get();

            return view('home.user', compact(
                'currentGames',
                'currentOnline',
                'graphData',
                'newBeatmaps',
                'news',
                'popularBeatmaps',
                'popularBeatmapsPlaycount',
                'totalUsers'
            ));
        } else {
            return view('home.landing', compact(
                'currentGames',
                'currentOnline',
                'graphData',
                'totalUsers'
            ));
        }
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
        return view('home.support-the-game')
        ->with('data', [
            // why support's blocks
            'blocks' => [
                // localization's name => icon
                'dev' => 'user',
                'time' => 'clock-o',
                'ads' => 'thumbs-up',
                'goodies' => 'star',
            ],

            // supporter's perks
            'perks' => [
                // localization's name => icon
                'osu_direct' => 'search',
                'auto_downloads' => 'cloud-download',
                'upload_more' => 'cloud-upload',
                'early_access' => 'flask',
                'customisation' => 'picture-o',
                'beatmap_filters' => 'filter',
                'yellow_fellow' => 'fire',
                'speedy_downloads' => 'dashboard',
                'change_username' => 'magic',
                'skinnables' => 'paint-brush',
                'feature_votes' => 'thumbs-up',
                'sort_options' => 'trophy',
                'feel_special' => 'heart',
                'more_to_come' => 'gift',
            ],
        ]);
    }
}
