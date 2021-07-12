<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Jobs\BeatmapsetDelete;
use App\Libraries\BeatmapsetDiscussionReview;
use App\Libraries\CommentBundle;
use App\Libraries\Search\BeatmapsetSearchCached;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
use App\Models\BeatmapDownload;
use App\Models\BeatmapMirror;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetWatch;
use App\Models\Genre;
use App\Models\Language;
use App\Transformers\BeatmapsetTransformer;
use Auth;
use Carbon\Carbon;
use DB;
use Request;

class BeatmapsetsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public', ['only' => ['search', 'show']]);
    }

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

        return ext_view('beatmapsets.index', compact('filters', 'beatmaps'));
    }

    public function show($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $set = $this->showJson($beatmapset);

        if (is_api_request()) {
            return $set;
        } else {
            $commentBundle = CommentBundle::forEmbed($beatmapset);

            if (priv_check('BeatmapsetMetadataEdit', $beatmapset)->can()) {
                $genres = Genre::listing();
                $languages = Language::listing();
            } else {
                $genres = [];
                $languages = [];
            }

            $noindex = !$beatmapset->esShouldIndex();

            return ext_view('beatmapsets.show', compact(
                'beatmapset',
                'commentBundle',
                'genres',
                'languages',
                'noindex',
                'set'
            ));
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
            'reviews_config' => BeatmapsetDiscussionReview::config(),
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
        if (!is_api_request() && !from_app_url()) {
            return ujs_redirect(route('beatmapsets.show', ['beatmapset' => $id]));
        }

        $beatmapset = Beatmapset::findOrFail($id);

        if ($beatmapset->download_disabled) {
            abort(404);
        }

        priv_check('BeatmapsetDownload', $beatmapset)->ensureCan();

        $recentlyDownloaded = BeatmapDownload::where('user_id', Auth::user()->user_id)
            ->where('timestamp', '>', Carbon::now()->subHour()->getTimestamp())
            ->count();

        if ($recentlyDownloaded > Auth::user()->beatmapsetDownloadAllowance()) {
            abort(429, osu_trans('beatmapsets.download.limit_exceeded'));
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
        $params = get_params(request()->all(), null, ['playmodes:string[]']);

        priv_check('BeatmapsetNominate', $beatmapset)->ensureCan();

        $nomination = $beatmapset->nominate(Auth::user(), $params['playmodes'] ?? []);
        if (!$nomination['result']) {
            return error_popup($nomination['message']);
        }

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

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

        return $beatmapset->defaultDiscussionJson();
    }

    public function removeFromLoved($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetLove')->ensureCan();

        $result = $beatmapset->removeFromLoved(Auth::user(), request('reason'));
        if (!$result['result']) {
            return error_popup($result['message']);
        }

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

        return $beatmapset->defaultDiscussionJson();
    }

    public function update($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);
        $params = request()->all();

        if (isset($params['description']) && is_string($params['description'])) {
            priv_check('BeatmapsetDescriptionEdit', $beatmapset)->ensureCan();

            $description = $params['description'];

            if (!$beatmapset->updateDescription($description, Auth::user())) {
                abort(422, 'failed updating description');
            }

            $beatmapset->refresh();
        }

        $metadataParams = get_params($params, 'beatmapset', [
            'language_id:int',
            'genre_id:int',
            'nsfw:bool',
        ]);

        if (count($metadataParams) > 0) {
            priv_check('BeatmapsetMetadataEdit', $beatmapset)->ensureCan();

            DB::transaction(function () use ($beatmapset, $metadataParams) {
                $oldGenreId = $beatmapset->genre_id;
                $oldLanguageId = $beatmapset->language_id;
                $oldNsfw = $beatmapset->nsfw;

                $beatmapset->fill($metadataParams)->saveOrExplode();

                if ($oldGenreId !== $beatmapset->genre_id) {
                    BeatmapsetEvent::log(BeatmapsetEvent::GENRE_EDIT, Auth::user(), $beatmapset, [
                        'old' => Genre::find($oldGenreId)->name,
                        'new' => $beatmapset->genre->name,
                    ])->saveOrExplode();
                }

                if ($oldLanguageId !== $beatmapset->language_id) {
                    BeatmapsetEvent::log(BeatmapsetEvent::LANGUAGE_EDIT, Auth::user(), $beatmapset, [
                        'old' => Language::find($oldLanguageId)->name,
                        'new' => $beatmapset->language->name,
                    ])->saveOrExplode();
                }

                if ($oldNsfw !== $beatmapset->nsfw) {
                    BeatmapsetEvent::log(BeatmapsetEvent::NSFW_TOGGLE, Auth::user(), $beatmapset, [
                        'old' => $oldNsfw,
                        'new' => $beatmapset->nsfw,
                    ])->saveOrExplode();
                }
            });
        }

        return $this->showJson($beatmapset);
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
                new BeatmapsetTransformer(),
                'beatmaps.max_combo'
            ),
            'cursor' => $search->getSortCursor(),
            'search' => [
                'sort' => $search->getParams()->getSort(),
            ],
            'recommended_difficulty' => $params->getRecommendedDifficulty(),
            'error' => search_error_message($search->getError()),
            'total' => $search->count(),
        ];
    }

    private function showJson($beatmapset)
    {
        $beatmapset->load([
            'beatmaps.baseMaxCombo',
            'beatmaps.difficulty',
            'beatmaps.failtimes',
            'genre',
            'language',
            'user',
        ]);

        return json_item($beatmapset, 'Beatmapset', [
            'beatmaps',
            'beatmaps.failtimes',
            'beatmaps.max_combo',
            'converts',
            'converts.failtimes',
            'current_user_attributes',
            'description',
            'genre',
            'language',
            'ratings',
            'recent_favourites',
            'related_users',
            'user',
        ]);
    }
}
