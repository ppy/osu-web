<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

use View;

class HomeController extends Controller
{
    protected $section = 'home';

    public function getNews()
    {
        return view('home.news');
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
            'osu-o', 'mania-o', 'fruits-o', 'taiko-o',
            'osu', 'mania', 'fruits', 'taiko',
            'bat', 'bubble', 'hourglass', 'dice', 'bomb', 'osu-spinner', 'net', 'mod-headphones',
            'easy-osu', 'normal-osu', 'hard-osu', 'insane-osu', 'expert-osu',
            'easy-taiko', 'normal-taiko', 'hard-taiko', 'insane-taiko', 'expert-taiko',
            'easy-fruits', 'normal-fruits', 'hard-fruits', 'insane-fruits', 'expert-fruits',
            'easy-mania', 'normal-mania', 'hard-mania', 'insane-mania', 'expert-mania',
        ]);
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
