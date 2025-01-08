<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller as BaseController;
use App\Libraries\ClientCheck;
use App\Models\Beatmap;
use App\Models\ScoreToken;
use App\Transformers\ScoreTokenTransformer;
use PDOException;

class ScoreTokensController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($beatmapId)
    {
        if (!$GLOBALS['cfg']['osu']['scores']['submission_enabled']) {
            abort(422, 'score submission is disabled');
        }

        $beatmap = Beatmap::increasesStatistics()->findOrFail($beatmapId);
        $user = auth()->user();
        $request = \Request::instance();

        $buildId = ClientCheck::parseToken($request)['buildId'];

        $scoreToken = new ScoreToken([
            'beatmap_id' => $beatmap->getKey(),
            'build_id' => $buildId,
            'user_id' => $user->getKey(),
            ...get_params($request->all(), null, [
                'beatmap_hash',
                'ruleset_id:int',
            ]),
        ]);
        $scoreToken->setRelation('beatmap', $beatmap);

        try {
            $scoreToken->saveOrExplode();
        } catch (PDOException $e) {
            // TODO: move this to be a validation inside Score model
            throw new InvariantException('failed creating score token');
        }

        return json_item($scoreToken, new ScoreTokenTransformer());
    }
}
