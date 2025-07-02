<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Libraries\Search\BeatmapsPassedSearch;
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
        $user = User::findOrFail($userId);

        $params = get_params(\Request::all(), null, [
            'beatmapset_ids:int[]',
        ], ['null_missing' => true]);

        if ($params['beatmapset_ids'] === null || count($params['beatmapset_ids']) === 0) {
            return response()->noContent();
        }

        $beatmaps = Beatmap::whereIn('beatmapset_id', array_slice($params['beatmapset_ids'], 0, 10))->get();
        $completedBeatmapIds = new BeatmapsPassedSearch($user->getKey(), $beatmaps->pluck('beatmap_id')->all())
            ->completedBeatmapIds();

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
