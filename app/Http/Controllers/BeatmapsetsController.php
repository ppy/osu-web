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

use App\Jobs\BeatmapsetDelete;
use App\Jobs\NotifyBeatmapsetUpdate;
use App\Libraries\CommentBundle;
use App\Libraries\Search\BeatmapsetSearchCached;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
use App\Models\BeatmapDownload;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\BeatmapsetWatch;
use App\Models\Country;
use App\Transformers\BeatmapsetTransformer;
use App\Transformers\CountryTransformer;
use Auth;
use Carbon\Carbon;
use Request;

class BeatmapsetsController extends Controller
{
    protected $section = 'beatmapsets';

    public function destroy($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetDelete', $beatmapset)->ensureCan();

        (new BeatmapsetDelete($beatmapset, Auth::user()))->handle();
    }

    public function index()
    {
        $beatmaps = $this->getSearchResponse();

        $filters = BeatmapsetSearchRequestParams::getAvailableFilters();

        return ext_view('beatmaps.index', compact('filters', 'beatmaps'));
    }

    public function show($id)
    {
        $beatmapset = Beatmapset
            ::with([
                'beatmaps.difficulty',
                'beatmaps.failtimes',
                'genre',
                'language',
                'user',
            ])
            ->findOrFail($id);

        $editable = priv_check('BeatmapsetDescriptionEdit', $beatmapset)->can();
        $descriptionInclude = $editable ? 'description:editable' : 'description';

        $set = json_item(
            $beatmapset,
            new BeatmapsetTransformer(),
            [
                'beatmaps',
                'beatmaps.failtimes',
                'beatmaps.max_combo',
                'converts',
                'converts.failtimes',
                'current_user_attributes',
                $descriptionInclude,
                'genre',
                'language',
                'ratings',
                'recent_favourites',
                'user',
            ]
        );

        if (is_api_request()) {
            return $set;
        } else {
            $commentBundle = CommentBundle::forEmbed($beatmapset);
            $countries = json_collection(Country::all(), new CountryTransformer);
            $hasDiscussion = $beatmapset->discussion_enabled;

            return ext_view('beatmapsets.show', compact('set', 'countries', 'hasDiscussion', 'beatmapset', 'commentBundle'));
        }
    }

    public function search()
    {
        $response = $this->getSearchResponse();

        return response($response, is_null($response['error']) ? 200 : 504);
    }

    public function discussion($id)
    {
        $returnJson = Request::input('format') === 'json';
        $requestLastUpdated = get_int(Request::input('last_updated'));

        $beatmapset = Beatmapset::where('discussion_enabled', true)->findOrFail($id);

        if ($returnJson) {
            $lastDiscussionUpdate = $beatmapset->lastDiscussionTime();
            $lastEventUpdate = $beatmapset->events()->max('updated_at');

            if ($lastEventUpdate !== null) {
                $lastEventUpdate = Carbon::parse($lastEventUpdate);
            }

            $latestUpdate = max($lastDiscussionUpdate, $lastEventUpdate);

            if ($latestUpdate === null || $requestLastUpdated >= $latestUpdate->timestamp) {
                return response([], 304);
            }
        }

        $initialData = [
            'beatmapset' => $beatmapset->defaultDiscussionJson(),
            'reviews_enabled' => config('osu.beatmapset.discussion_review_enabled'),
        ];

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

        if ($returnJson) {
            return $initialData;
        } else {
            return ext_view('beatmapsets.discussion', compact('beatmapset', 'initialData'));
        }
    }

    public function discussionUnlock($id)
    {
        priv_check('BeatmapsetDiscussionLock')->ensureCan();

        $beatmapset = Beatmapset::where('discussion_enabled', true)->findOrFail($id);
        $beatmapset->discussionUnlock(Auth::user(), request('reason'));

        return $beatmapset->defaultDiscussionJson();
    }

    public function discussionLock($id)
    {
        priv_check('BeatmapsetDiscussionLock')->ensureCan();

        $beatmapset = Beatmapset::where('discussion_enabled', true)->findOrFail($id);
        $beatmapset->discussionLock(Auth::user(), request('reason'));

        return $beatmapset->defaultDiscussionJson();
    }

    public function download($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        if ($beatmapset->download_disabled) {
            abort(404);
        }

        priv_check('BeatmapsetDownload', $beatmapset)->ensureCan();

        $recentlyDownloaded = BeatmapDownload::where('user_id', Auth::user()->user_id)
            ->where('timestamp', '>', Carbon::now()->subHour()->getTimestamp())
            ->count();

        if ($recentlyDownloaded > Auth::user()->beatmapsetDownloadAllowance()) {
            abort(403);
        }

        $noVideo = get_bool(Request::input('noVideo', false));
        $mirror = BeatmapMirror::getRandomForRegion(request_country(request()));

        BeatmapDownload::create([
            'user_id' => Auth::user()->user_id,
            'timestamp' => Carbon::now()->getTimestamp(),
            'beatmapset_id' => $beatmapset->beatmapset_id,
            'fulfilled' => 1,
            'mirror_id' => $mirror->mirror_id,
        ]);

        return redirect($mirror->generateURL($beatmapset, $noVideo));
    }

    public function nominate($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetNominate', $beatmapset)->ensureCan();

        $nomination = $beatmapset->nominate(Auth::user());
        if (!$nomination['result']) {
            return error_popup($nomination['message']);
        }

        BeatmapsetWatch::markRead($beatmapset, Auth::user());
        (new NotifyBeatmapsetUpdate([
            'user' => Auth::user(),
            'beatmapset' => $beatmapset,
        ]))->delayedDispatch();

        return $beatmapset->defaultDiscussionJson();
    }

    public function love($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetLove')->ensureCan();

        $nomination = $beatmapset->love(Auth::user());
        if (!$nomination['result']) {
            return error_popup($nomination['message']);
        }

        BeatmapsetWatch::markRead($beatmapset, Auth::user());
        (new NotifyBeatmapsetUpdate([
            'user' => Auth::user(),
            'beatmapset' => $beatmapset,
        ]))->delayedDispatch();

        return $beatmapset->defaultDiscussionJson();
    }

    public function update($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetDescriptionEdit', $beatmapset)->ensureCan();

        $description = Request::input('description');

        if ($beatmapset->updateDescription($description, Auth::user())) {
            $beatmapset->refresh();

            return json_item(
                $beatmapset,
                new BeatmapsetTransformer(),
                [
                    'description:editable',
                ]
            );
        }

        return response([], 500); // ?????
    }

    private function getSearchResponse()
    {
        $params = new BeatmapsetSearchRequestParams(request()->all(), Auth::user());
        $search = (new BeatmapsetSearchCached($params));

        $records = datadog_timing(function () use ($search) {
            return $search->records();
        }, config('datadog-helper.prefix_web').'.search', ['type' => 'beatmapset']);

        return [
            'beatmapsets' => json_collection(
                $records,
                new BeatmapsetTransformer,
                'beatmaps'
            ),
            'cursor' => $search->getSortCursor(),
            'recommended_difficulty' => $params->getRecommendedDifficulty(),
            'error' => search_error_message($search->getError()),
            'total' => $search->count(),
        ];
    }
}
