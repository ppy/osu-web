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

use App\Models\Beatmap;
use App\Models\BeatmapDownload;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Transformers\BeatmapsetTransformer;
use App\Transformers\CountryTransformer;
use Auth;
use Carbon\Carbon;
use Request;

class BeatmapsetsController extends Controller
{
    protected $section = 'beatmapsets';

    public function index()
    {
        $languages = Language::listing();
        $genres = Genre::listing();
        $beatmaps = json_collection(
            Beatmapset::search($this->searchParams())['data'],
            new BeatmapsetTransformer,
            'beatmaps'
        );

        // temporarily put filters here
        $modes = [['id' => null, 'name' => trans('beatmaps.mode.any')]];
        foreach (Beatmap::MODES as $name => $id) {
            $modes[] = ['id' => $id, 'name' => trans("beatmaps.mode.{$name}")];
        }

        $statuses = [
            ['id' => 7, 'name' => trans('beatmaps.status.any')],
            ['id' => 0, 'name' => trans('beatmaps.status.ranked-approved')],
            ['id' => 1, 'name' => trans('beatmaps.status.approved')],
            ['id' => 8, 'name' => trans('beatmaps.status.loved')],
            ['id' => 2, 'name' => trans('beatmaps.status.faves')],
            ['id' => 3, 'name' => trans('beatmaps.status.modreqs')],
            ['id' => 4, 'name' => trans('beatmaps.status.pending')],
            ['id' => 5, 'name' => trans('beatmaps.status.graveyard')],
            ['id' => 6, 'name' => trans('beatmaps.status.my-maps')],
        ];

        $extras = [
            ['id' => 'video', 'name' => trans('beatmaps.extra.video')],
            ['id' => 'storyboard', 'name' => trans('beatmaps.extra.storyboard')],
        ];

        $ranks = [];
        foreach (['XH', 'X', 'SH', 'S', 'A', 'B', 'C', 'D'] as $rank) {
            $ranks[] = ['id' => $rank, 'name' => trans("beatmaps.rank.{$rank}")];
        }

        $filters = compact('modes', 'statuses', 'genres', 'languages', 'extras', 'ranks');

        return view('beatmaps.index', compact('filters', 'beatmaps'));
    }

    public function show($id)
    {
        $beatmapset = Beatmapset
            ::with('beatmaps.failtimes', 'user')
            ->findOrFail($id);

        $set = json_item(
            $beatmapset,
            new BeatmapsetTransformer(),
            [
                'availability',
                'beatmaps',
                'beatmaps.failtimes',
                'converts',
                'converts.failtimes',
                'description',
                'discussion_status',
                'ratings',
                'user',
            ]
        );

        if (Request::is('api/*')) {
            return $set;
        } else {
            $countries = json_collection(Country::all(), new CountryTransformer);
            $hasDiscussion = $beatmapset->beatmapsetDiscussion()->exists();

            $title = trans('layout.menu.beatmaps._').' / '.$beatmapset->artist.' - '.$beatmapset->title;

            return view('beatmapsets.show', compact('set', 'title', 'countries', 'hasDiscussion', 'beatmapset'));
        }
    }

    public function search()
    {
        $user = Auth::user();

        $params = $this->searchParams();
        $beatmaps = Beatmapset::search($params)['data'];

        return json_collection(
            $beatmaps,
            new BeatmapsetTransformer,
            'beatmaps'
        );
    }

    public function discussion($id)
    {
        $returnJson = Request::input('format') === 'json';
        $lastUpdated = get_int(Request::input('last_updated'));

        $beatmapset = Beatmapset::findOrFail($id);

        $discussion = $beatmapset->beatmapsetDiscussion()->firstOrFail();

        if ($returnJson && $lastUpdated !== null && $lastUpdated >= $discussion->updated_at->timestamp) {
            return response([], 304);
        }

        $initialData = [
            'beatmapset' => $beatmapset->defaultJson(),
            'beatmapsetDiscussion' => $discussion->defaultJson(),
        ];

        if ($returnJson) {
            return $initialData;
        } else {
            return view('beatmapsets.discussion', compact('beatmapset', 'initialData'));
        }
    }

    public function download($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        if ($beatmapset->download_disabled) {
            abort(404);
        }

        priv_check('BeatmapsetDownload', $beatmapset)->ensureCan();

        $noVideo = get_bool(Request::input('noVideo', false));
        $mirror = BeatmapMirror::getRandomForRegion(Request::header('CF_IPCOUNTRY'));

        BeatmapDownload::create([
            'user_id' => Auth::user()->user_id,
            'timestamp' => Carbon::now()->getTimestamp(),
            'beatmapset_id' => $beatmapset->beatmapset_id,
            'fulfilled' => 1,
            'mirror_id' => $mirror->mirror_id,
        ]);

        return redirect($mirror->generateUrl($beatmapset, $noVideo));
    }

    public function nominate($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetNominate', $beatmapset)->ensureCan();

        if (!$beatmapset->nominate(Auth::user())) {
            return error_popup(trans('beatmaps.nominations.incorrect-state'));
        }

        return [
            'beatmapset' => $beatmapset->defaultJson(),
            'beatmapsetDiscussion' => $beatmapset->beatmapsetDiscussion->defaultJson(),
        ];
    }

    public function disqualify($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetDisqualify', $beatmapset)->ensureCan();

        if (!$beatmapset->disqualify(Auth::user(), Request::input('comment'))) {
            return error_popup(trans('beatmaps.nominations.incorrect-state'));
        }

        return [
            'beatmapset' => $beatmapset->defaultJson(),
            'beatmapsetDiscussion' => $beatmapset->beatmapsetDiscussion->defaultJson(),
        ];
    }

    public function updateFavourite($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);
        $user = Auth::user();

        if (Request::input('action') === 'favourite') {
            priv_check('UserFavourite')->ensureCan();
            $beatmapset->favourite($user);
        } elseif (Request::input('action') === 'unfavourite') {
            priv_check('UserFavouriteRemove')->ensureCan();
            $beatmapset->unfavourite($user);
        }

        // reload models to get the correct favourite status
        return [
          'favcount' => $beatmapset->fresh()->favourite_count,
          'favourited' => $user->fresh()->hasFavourited($beatmapset),
        ];
    }

    private function searchParams()
    {
        $user = Auth::user();

        if ($user === null) {
            $params = [
                'page' => Request::input('page'),
            ];
        } else {
            $params = [
                'query' => Request::input('q'),
                'mode' => Request::input('m'),
                'status' => Request::input('s'),
                'genre' => Request::input('g'),
                'language' => Request::input('l'),
                'extra' => Request::input('e'),
                'page' => Request::input('page'),
                'sort' => Request::input('sort'),
                'user' => $user,
            ];

            if ($user->isSupporter()) {
                $params['rank'] = Request::input('r');
            }
        }

        return $params;
    }
}
