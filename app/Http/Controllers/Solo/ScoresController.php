<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Solo;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Solo\Score;
use App\Models\Solo\ScoreToken;
use App\Transformers\ScoreTransformer;
use DB;

class ScoresController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($beatmapId, $tokenId)
    {
        $score = DB::transaction(function () use ($beatmapId, $tokenId) {
            $user = auth()->user();
            $scoreToken = ScoreToken::where([
                'beatmap_id' => $beatmapId,
                'user_id' => $user->getKey(),
            ])->lockForUpdate()->findOrFail($tokenId);

            // return existing score otherwise (assuming duplicated submission)
            if ($scoreToken->score_id === null) {
                $params = get_params(request()->all(), null, [
                    'accuracy:float',
                    'max_combo:int',
                    'maximum_statistics:array',
                    'mods:array',
                    'passed:bool',
                    'rank:string',
                    'statistics:array',
                    'total_score:int',
                ]);

                $params = array_merge($params, [
                    'beatmap_id' => $scoreToken->beatmap_id,
                    'build_id' => $scoreToken->build_id,
                    'ended_at' => json_time(now()),
                    'mods' => app('mods')->parseInputArray($scoreToken->ruleset_id, $params['mods'] ?? []),
                    'ruleset_id' => $scoreToken->ruleset_id,
                    'started_at' => $scoreToken->created_at_json,
                    'user_id' => $scoreToken->user_id,
                ]);

                $score = Score::createFromJsonOrExplode($params);
                $score->createLegacyEntryOrExplode();
                $scoreToken->fill(['score_id' => $score->getKey()])->saveOrExplode();
            } else {
                // assume score exists and is valid
                $score = $scoreToken->score;
            }

            return $score;
        });

        $scoreJson = json_item($score, new ScoreTransformer(ScoreTransformer::TYPE_SOLO));
        if ($score->wasRecentlyCreated) {
            $score::queueForProcessing($scoreJson);
        }

        return $scoreJson;
    }
}
