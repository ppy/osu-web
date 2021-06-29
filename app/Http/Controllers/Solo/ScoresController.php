<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Solo;

use App\Http\Controllers\Controller as BaseController;
use App\Libraries\Multiplayer\Mod;
use App\Models\Solo\Score;
use App\Models\Solo\ScoreToken;

class ScoresController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($beatmapId, $tokenId)
    {
        $user = auth()->user();
        $scoreToken = ScoreToken::where([
            'beatmap_id' => $beatmapId,
            'user_id' => $user->getKey(),
        ])->whereNull('score_id')->findOrFail($tokenId);

        $params = get_params(request()->all(), null, [
            'accuracy:float',
            'max_combo:int',
            'mods:array',
            'passed:bool',
            'rank:string',
            'statistics:array',
            'total_score:int',
        ]);

        $params = array_merge($params, [
            'beatmap_id' => $scoreToken->beatmap_id,
            'ended_at' => now(),
            'mods' => Mod::parseInputArray($params['mods'] ?? [], $scoreToken->ruleset_id),
            'ruleset_id' => $scoreToken->ruleset_id,
            'started_at' => $scoreToken->created_at,
            'user_id' => $scoreToken->user_id,
        ]);

        $score = new Score();

        $score->getConnection()->transaction(function () use ($params, $score, $scoreToken) {
            $score->complete($params);
            $score->createLegacyEntry();
            $scoreToken->fill(['score_id' => $score->getKey()])->saveOrExplode();
        });

        return json_item($score, 'Solo\Score');
    }
}
