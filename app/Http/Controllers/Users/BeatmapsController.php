<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Exceptions\RequestTooLargeException;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RequestCost;
use App\Libraries\Search\BeatmapsPassedSearch;
use App\Models\Beatmap;
use App\Models\User;
use App\Transformers\BeatmapCompactTransformer;

/**
 * @group Users
 */
class BeatmapsController extends Controller
{
    private const LIMIT = 50;

    public function __construct()
    {
        $this->middleware('require-scopes:public');
    }

    /**
     * Search Beatmaps Passed
     *
     * Searches for the Beatmaps a User has passed by Beatmapset.
     *
     * ---
     *
     * ### Response format
     *
     * Returns the list of [Beatmaps](#beatmap) completed matching the criteria.
     *
     * Field           | Type
     * --------------- | ----
     * beatmaps_passed | [Beatmap](#beatmap)[]
     *
     * @urlParam user integer required The id of the user.
     * @queryParam beatmapset_ids integer[] The list of Beatmapset. Example: [1,2]
     * @queryParam exclude_converts bool Whether or not to exclude converts. No-example
     * @queryParam is_legacy bool Whether or not to consider legacy scores. Leave empty for all scores. No-example
     * @queryParam no_diff_reduction bool Whether or not to exclude diff reduction mods. Defaults to true. No-example
     * @queryParam ruleset_id int The [Ruleset](#ruleset) ID. Leave empty for all rulesets. No-example
     */
    public function beatmapsPassed($userId)
    {
        $user = User::findOrFail($userId);

        $params = get_params(\Request::all(), null, [
            'beatmapset_ids:int[]',
            'exclude_converts:bool',
            'is_legacy:bool',
            'no_diff_reduction:bool',
            'ruleset_id:int',
        ], ['null_missing' => true]);

        $beatmapsetIds = $params['beatmapset_ids'] ?? [];
        $count = count($beatmapsetIds);

        if ($count === 0) {
            return ['beatmaps_passed' => []];
        }
        if ($count > self::LIMIT) {
            throw new RequestTooLargeException('beatmapset_ids', self::LIMIT);
        }

        RequestCost::setCost($count);

        $beatmaps = Beatmap::whereIn('beatmapset_id', $beatmapsetIds)->get();
        $completedBeatmapIds = BeatmapsPassedSearch::completedIds(
            $user->getKey(),
            $beatmaps->pluck('beatmap_id')->all(),
            $params['no_diff_reduction'] ?? true,
            $params['ruleset_id'],
            $params['is_legacy'],
            $params['exclude_converts'],
        );

        $completedBeatmaps = [];
        $beatmapsById = $beatmaps->keyBy('beatmap_id');
        foreach ($completedBeatmapIds as $beatmapId) {
            $completedBeatmaps[] = $beatmapsById[$beatmapId];
        }

        return [
            'beatmaps_passed' => json_collection($completedBeatmaps, new BeatmapCompactTransformer()),
        ];
    }
}
