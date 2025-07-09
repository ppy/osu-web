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

class ScoresController extends Controller
{
    private const LIMIT = 50;

    public function __construct()
    {
        $this->middleware('require-scopes:public');
    }

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
            return ['completed_beatmaps' => []];
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
            'completed_beatmaps' => json_collection($completedBeatmaps, new BeatmapCompactTransformer()),
        ];
    }
}
