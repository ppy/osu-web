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

use App\Models\BeatmapSet;
use App\Transformers\BeatmapSetTransformer;
use Auth;
use Request;

class BeatmapsetsController extends Controller
{
    protected $section = 'beatmapsets';

    public function discussion($id)
    {
        $returnJson = Request::input('format') === 'json';
        $lastUpdated = get_int(Request::input('last_updated'));

        $beatmapset = BeatmapSet::findOrFail($id);

        $discussion = $beatmapset->beatmapsetDiscussion()->firstOrFail();

        if ($returnJson && $lastUpdated !== null && $lastUpdated >= $discussion->updated_at->timestamp) {
            return ['updated' => false];
        }

        $initialData = [
            'beatmapset' => fractal_item_array(
                $beatmapset,
                new BeatmapSetTransformer,
                'user,beatmaps'
            ),

            'beatmapsetDiscussion' => $discussion->defaultJson(Auth::user()),
        ];

        if ($returnJson) {
            return $initialData;
        } else {
            return view('beatmapsets.discussion', compact('initialData'));
        }
    }

    public function getBeatmapset($id)
    {
        $beatmapSet = BeatmapSet::find($id);

        $set = fractal_item_array(
            $beatmapSet,
            new BeatmapSetTransformer(),
            implode (',', ['beatmaps.scoresBest.user', 'beatmaps.failtimes'])
        );

        $title = trans('layout.menu.beatmaps._')." / ".$beatmapSet->artist." - ".$beatmapSet->title;

        return view('beatmapsets.show', compact('set', 'title'));
    }
}
