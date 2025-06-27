<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;
use App\Models\Beatmap;
use App\Models\User;
use App\Transformers\BeatmapCompactTransformer;

class ScoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public');
    }

    public function beatmapsetCompletion($userId)
    {
        $params = get_params(\Request::all(), null, [
            'beatmapset_ids:int[]',
        ], ['null_missing' => true]);

        User::findOrFail($userId);

        if ($params['beatmapset_ids'] === null || count($params['beatmapset_ids']) === 0) {
            return response()->noContent();
        }

        $beatmaps = Beatmap::whereIn('beatmapset_id', array_slice($params['beatmapset_ids'], 0, 10))->get();

        // TODO: combine with pack completion
        static $aggName = 'by_beatmap';

        $searchParams = ScoreSearchParams::fromArray([
            'beatmap_ids' => $beatmaps->pluck('beatmap_id')->all(),
            'exclude_mods' => app('mods')->difficultyReductionIds->toArray(),
            'exclude_without_pp' => true,
            'is_legacy' => false,
            'limit' => 0,
            'user_id' => intval($userId),
        ]);

        $search = new ScoreSearch($searchParams);
        $search->size(0);
        $search->setAggregations([$aggName => [
            'terms' => [
                'field' => 'beatmap_id',
                'size' => max(1, $beatmaps->count()),
            ],
            'aggs' => [
                'scores' => [
                    'top_hits' => [
                        'size' => 1,
                    ],
                ],
            ],
        ]]);

        $response = $search->response();
        $search->assertNoError();

        $beatmapsById = $beatmaps->keyBy('beatmap_id');
        $completedBeatmapIds = array_map(
            fn (array $hit): int => (int) $hit['key'],
            $response->aggregations($aggName)['buckets'],
        );

        $completedBeatmaps = [];
        foreach ($completedBeatmapIds as $beatmapId) {
            $completedBeatmaps[] = $beatmapsById[$beatmapId];
        }

        return [
            'completed_beatmaps' => json_collection($completedBeatmaps, new BeatmapCompactTransformer()),
        ];
    }
}
