<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\Handler as ExceptionsHandler;
use App\Jobs\BeatmapsetDelete;
use App\Libraries\BeatmapsetDiscussion\Review;
use App\Libraries\CommentBundle;
use App\Libraries\Search\BeatmapsetSearchCached;
use App\Libraries\Search\BeatmapsetSearchRequestParams;
use App\Models\Beatmap;
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
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Beatmapsets
 */
class BeatmapsetsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public', ['only' => ['lookup', 'search', 'show']]);
    }

    public function destroy($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetDelete', $beatmapset)->ensureCan();

        (new BeatmapsetDelete($beatmapset, Auth::user()))->handle();
    }

    public function index()
    {
        $canAdvancedSearch = priv_check('BeatmapsetAdvancedSearch')->can();
        // only cache if guest user and guest advanced search is disabled
        $beatmapsetsJsonString = !Auth::check() && !$canAdvancedSearch
            ? cache_remember_mutexed(
                'beatmapsets_guest_str',
                600,
                '{}',
                fn () => json_encode($this->getSearchResponse([])['content'])
            ) : json_encode($this->getSearchResponse()['content']);

        return ext_view('beatmapsets.index', [
            'beatmapsetsJsonString' => $beatmapsetsJsonString,
            'canAdvancedSearch' => $canAdvancedSearch,
        ]);
    }

    public function lookup()
    {
        $beatmapId = get_int(request('beatmap_id'));

        if ($beatmapId === null) {
            abort(404);
        }

        $beatmap = Beatmap::findOrFail($beatmapId);

        return $this->show($beatmap->beatmapset_id);
    }

    public function show($id)
    {
        $beatmapset = $this->findBeatmapset($id);

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
            $config = [
                'tags_min_votes_display' => $GLOBALS['cfg']['osu']['beatmap_tags']['min_votes_display'],
            ];

            set_opengraph($beatmapset);

            return ext_view('beatmapsets.show', compact(
                'beatmapset',
                'commentBundle',
                'config',
                'genres',
                'languages',
                'noindex',
                'set'
            ));
        }
    }

    /**
     * Search Beatmapset
     *
     * TODO: documentation
     *
     * @usesCursor
     */
    public function search()
    {
        $response = $this->getSearchResponse();

        return response($response['content'], $response['status']);
    }

    public function discussion($id)
    {
        $beatmapset = $this->findBeatmapset($id);

        $initialData = [
            'beatmapset' => $beatmapset->defaultDiscussionJson(),
            'reviews_config' => Review::config(),
        ];

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

        if (is_json_request()) {
            return $initialData;
        } else {
            return ext_view('beatmapsets.discussion', compact('beatmapset', 'initialData'));
        }
    }

    public function discussionLastUpdate($id)
    {
        return response(['last_update' => Beatmapset::findOrFail($id)->lastDiscussionTime()]);
    }

    public function discussionUnlock($id)
    {
        priv_check('BeatmapsetDiscussionLock')->ensureCan();

        $beatmapset = Beatmapset::findOrFail($id);
        $beatmapset->discussionUnlock(Auth::user());

        return $beatmapset->defaultDiscussionJson();
    }

    public function discussionLock($id)
    {
        priv_check('BeatmapsetDiscussionLock')->ensureCan();

        $beatmapset = Beatmapset::findOrFail($id);
        $beatmapset->discussionLock(Auth::user(), request('reason'));

        return $beatmapset->defaultDiscussionJson();
    }

    public function download($id)
    {
        if (!is_api_request() && !from_app_url()) {
            return ujs_redirect(route('beatmapsets.show', ['beatmapset' => rawurlencode($id)]));
        }

        $beatmapset = Beatmapset::findOrFail($id);

        if ($beatmapset->download_disabled) {
            abort(404);
        }

        priv_check('BeatmapsetDownload', $beatmapset)->ensureCan();

        $user = Auth::user();
        $userId = $user->getKey();
        $recentlyDownloaded = BeatmapDownload::where('user_id', $userId)
            ->where('timestamp', '>', Carbon::now()->subHours()->getTimestamp())
            ->count();

        if ($recentlyDownloaded > $user->beatmapsetDownloadAllowance()) {
            abort(429, osu_trans('beatmapsets.download.limit_exceeded'));
        }

        $noVideo = get_bool(Request::input('noVideo', false));
        $mirror = BeatmapMirror::getRandomForRegion(request_country())
            ?? BeatmapMirror::getDefault()
            ?? abort(503, osu_trans('beatmapsets.download.no_mirrors'));

        BeatmapDownload::create([
            'user_id' => $userId,
            'timestamp' => time(),
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

        $beatmapset->nominate(Auth::user(), $params['playmodes'] ?? []);

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

        return $beatmapset->defaultDiscussionJson();
    }

    public function love($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $params = get_params(request()->all(), null, ['beatmap_ids:int[]'], ['null_missing' => true]);

        priv_check('BeatmapsetLove')->ensureCan();

        $nomination = $beatmapset->love(Auth::user(), $params['beatmap_ids']);
        if (!$nomination['result']) {
            return error_popup($nomination['message']);
        }

        BeatmapsetWatch::markRead($beatmapset, Auth::user());

        return $beatmapset->defaultDiscussionJson();
    }

    public function removeFromLoved($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        priv_check('BeatmapsetRemoveFromLoved')->ensureCan();

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
            'genre_id:int',
            'language_id:int',
            'nsfw:bool',
        ]);

        if (count($metadataParams) > 0) {
            priv_check('BeatmapsetMetadataEdit', $beatmapset)->ensureCan();
        }

        $updateParams = [
            ...$metadataParams,
            ...get_params($params, 'beatmapset', [
                'offset:int',
                'tags:string',
            ]),
        ];

        if (array_key_exists('offset', $updateParams)) {
            priv_check('BeatmapsetOffsetEdit')->ensureCan();
        }

        if (array_key_exists('tags', $updateParams)) {
            priv_check('BeatmapsetTagsEdit')->ensureCan();
        }

        if (count($updateParams) > 0) {
            DB::transaction(function () use ($beatmapset, $updateParams) {
                $oldGenreId = $beatmapset->genre_id;
                $oldLanguageId = $beatmapset->language_id;
                $oldNsfw = $beatmapset->nsfw;
                $oldOffset = $beatmapset->offset;
                $oldTags = $beatmapset->tags;
                $user = auth()->user();

                $beatmapset->fill($updateParams)->saveOrExplode();

                if ($oldGenreId !== $beatmapset->genre_id) {
                    BeatmapsetEvent::log(BeatmapsetEvent::GENRE_EDIT, $user, $beatmapset, [
                        'old' => Genre::find($oldGenreId)->name,
                        'new' => $beatmapset->genre->name,
                    ])->saveOrExplode();
                }

                if ($oldLanguageId !== $beatmapset->language_id) {
                    BeatmapsetEvent::log(BeatmapsetEvent::LANGUAGE_EDIT, $user, $beatmapset, [
                        'old' => Language::find($oldLanguageId)->name,
                        'new' => $beatmapset->language->name,
                    ])->saveOrExplode();
                }

                if ($oldNsfw !== $beatmapset->nsfw) {
                    BeatmapsetEvent::log(BeatmapsetEvent::NSFW_TOGGLE, $user, $beatmapset, [
                        'old' => $oldNsfw,
                        'new' => $beatmapset->nsfw,
                    ])->saveOrExplode();
                }

                if ($oldOffset !== $beatmapset->offset) {
                    BeatmapsetEvent::log(BeatmapsetEvent::OFFSET_EDIT, $user, $beatmapset, [
                        'old' => $oldOffset,
                        'new' => $beatmapset->offset,
                    ])->saveOrExplode();
                }

                if ($oldTags !== $beatmapset->tags) {
                    BeatmapsetEvent::log(BeatmapsetEvent::TAGS_EDIT, $user, $beatmapset, [
                        'old' => $oldTags,
                        'new' => $beatmapset->tags,
                    ])->saveOrExplode();
                }
            });
        }

        return $this->showJson($beatmapset);
    }

    public function versions(string $id): Response
    {
        $beatmapset = Beatmapset::findOrFail($id)->load([
            'versions' => fn ($q) => $q->orderByDesc('version_id'),
            'versions.versionFiles',
        ]);
        $versions = $beatmapset->versions->keyBy('version_id');
        foreach ($versions as $version) {
            $version->setRelation('previousVersion', $versions[$version->previous_version_id] ?? null);
        }

        return ext_view('beatmapsets.versions', [
            'beatmapset' => $beatmapset,
            'versions' => $versions,
        ]);
    }

    private function getSearchResponse(?array $params = null)
    {
        $params = new BeatmapsetSearchRequestParams($params ?? request()->all(), auth()->user());
        $search = new BeatmapsetSearchCached($params);

        $records = datadog_timing(function () use ($search) {
            return $search->records();
        }, $GLOBALS['cfg']['datadog-helper']['prefix_web'].'.search', ['type' => 'beatmapset']);

        $error = $search->getError();

        return [
            'content' => array_merge([
                'beatmapsets' => json_collection(
                    $records,
                    new BeatmapsetTransformer(),
                    ['beatmaps.max_combo', 'pack_tags']
                ),
                'search' => [
                    'sort' => $search->getParams()->getSort(),
                ],
                'recommended_difficulty' => $params->getRecommendedDifficulty(),
                'error' => search_error_message($error),
                'total' => $search->count(),
            ], cursor_for_response($search->getSortCursor())),
            'status' => $error === null ? 200 : ExceptionsHandler::statusCode($error),
        ];
    }

    private function findBeatmapset($id): Beatmapset
    {
        return (
            priv_check('BeatmapsetShowDeleted')->can()
                ? Beatmapset::withTrashed()->whereHas('allBeatmaps')
                : Beatmapset::whereHas('beatmaps')
        )->findOrFail($id);
    }

    private function showJson($beatmapset)
    {
        $beatmapRelation = $beatmapset->trashed()
            ? 'allBeatmaps'
            : 'beatmaps';
        $userId = \Auth::id();
        $beatmapset->load([
            "{$beatmapRelation}" => fn ($q) => $q->withUserPlaycount($userId)->withUserTagIds($userId),
            "{$beatmapRelation}.baseDifficultyRatings",
            "{$beatmapRelation}.baseMaxCombo",
            "{$beatmapRelation}.failtimes",
            "{$beatmapRelation}.beatmapOwners.user",
            'genre',
            'language',
            'user',
        ]);

        $transformer = new BeatmapsetTransformer();
        $transformer->relatedUsersType = 'show';

        static $sharedIncludes = [
            'failtimes',
            'owners',
            'top_tag_ids',
        ];

        return json_item($beatmapset, $transformer, [
            ...array_map(fn ($include) => "beatmaps.{$include}", $sharedIncludes),
            'beatmaps.current_user_playcount',
            'beatmaps.current_user_tag_ids',
            'beatmaps.max_combo',
            ...array_map(fn ($include) => "converts.{$include}", $sharedIncludes),
            'current_nominations',
            'current_user_attributes',
            'description',
            'genre',
            'language',
            'pack_tags',
            'ratings',
            'recent_favourites',
            'related_tags',
            'related_users',
            'user',
            'version_count',
        ]);
    }
}
