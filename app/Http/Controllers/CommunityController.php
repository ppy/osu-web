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

use Cache;

class CommunityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Community Controller
    |--------------------------------------------------------------------------
    |
    | Frontend to the community of osu!
    | Unsure if forum should use /forum or not.
    | Route:
    |
    |	Route::get('/community</page>', 'CommunityController@get<Page>');
    |
    */
    protected $section = 'community';

    public function getChat()
    {
        return view('community.chat');
    }

    public function getLive()
    {
        $streams = null;
        if (!Cache::has("livestreams"))
        {
            $justin_api_url = "https://api.twitch.tv/kraken/streams?on_site=1&limit=40&offset=0&game=Osu!";
            $data = json_decode(file_get_contents($justin_api_url));
            $streams = $data->streams;
            Cache::put('livestreams', $streams, 300);
        } else {
            $streams = Cache::get("livestreams");
        }

        return view('community.live', compact("streams"));
    }
}
