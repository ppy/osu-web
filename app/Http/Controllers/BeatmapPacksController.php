<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\BeatmapPack;
use App\Transformers\BeatmapPackTransformer;

/**
 * @group Beatmap Packs
 */
class BeatmapPacksController extends Controller
{
    private const PER_PAGE = 100;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    /**
     * Get Beatmap Packs
     *
     * Returns a list of beatmap packs.
     *
     * ---
     *
     * ### Response format
     *
     * Field         | Type
     * ------------- | -----------------------------
     * beatmap_packs | [BeatmapPack](#beatmappack)[]
     *
     * @usesCursor
     * @queryParam type string [BeatmapPackType](#beatmappacktype) of the beatmap packs to be returned. Defaults to `standard`.
     */
    public function index()
    {
        $params = request()->all();
        $type = presence(get_string($params['type'] ?? null)) ?? BeatmapPack::DEFAULT_TYPE;
        $query = BeatmapPack::getPacks($type);
        if ($query === null) {
            abort(404);
        }

        if (is_api_request()) {
            $cursorHelper = BeatmapPack::makeDbCursorHelper();
            [$packs, $hasMore] = $query
                ->cursorSort($cursorHelper, cursor_from_params($params))
                ->limit(static::PER_PAGE)
                ->getWithHasMore();

            return [
                'beatmap_packs' => json_collection($packs, new BeatmapPackTransformer()),
                ...cursor_for_response($cursorHelper->next($packs, $hasMore)),
            ];
        } else {
            return ext_view('packs.index', [
                'packs' => $query->paginate(static::PER_PAGE)->appends(['type' => $type]),
                'type' => $type,
            ]);
        }
    }

    /**
     * Get Beatmap Pack
     *
     * Gets the beatmap pack for the specified beatmap pack tag.
     *
     * ---
     *
     * ### Response format
     *
     * Returns [BeatmapPack](#beatmappack) object.
     * The following attributes are always included as well:
     *
     * Attribute            |
     * -------------------- |
     * beatmapsets          |
     * user_completion_data |
     *
     * @urlParam pack string required The tag of the beatmap pack to be returned.
     *
     * @queryParam legacy_only integer Whether or not to consider lazer scores for user completion data. Defaults to 1. Example: 0
     */
    public function show($idOrTag)
    {
        $query = BeatmapPack::default();

        if (!is_api_request() && ctype_digit($idOrTag)) {
            $pack = $query->findOrFail($idOrTag);

            return ujs_redirect(route('packs.show', $pack));
        }

        $pack = $query->where('tag', $idOrTag)->firstOrFail();
        $mode = Beatmap::modeStr($pack->playmode ?? 0);
        $sets = $pack->beatmapsets;
        $currentUser = \Auth::user();
        $userCompletionData = $pack->userCompletionData(
            $currentUser,
            ScoreSearchParams::showLegacyForUser($currentUser),
        );

        if (is_api_request()) {
            return json_item(
                $pack,
                new BeatmapPackTransformer($userCompletionData),
                ['beatmapsets', 'user_completion_data']
            );
        }

        $view = request('format') === 'raw' ? 'packs.raw' : 'packs.show';

        return ext_view($view, compact('mode', 'pack', 'sets', 'userCompletionData'));
    }
}
