<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Solo;

use App\Exceptions\InvariantException;
use App\Http\Controllers\Controller as BaseController;
use App\Libraries\ClientCheck;
use App\Models\Beatmap;
use App\Models\Solo\ScoreToken;
use PDOException;

class ScoreTokensController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($beatmapId)
    {
        $beatmap = Beatmap::increasesStatistics()->findOrFail($beatmapId);
        $user = auth()->user();
        $params = request()->all();

        $build = ClientCheck::findBuild($user, $params);

        try {
            $scoreToken = ScoreToken::create([
                'beatmap_id' => $beatmap->getKey(),
                'build_id' => $build?->getKey(),
                'ruleset_id' => get_int($params['ruleset_id'] ?? null),
                'user_id' => $user->getKey(),
            ]);
        } catch (PDOException $e) {
            // TODO: move this to be a validation inside Score model
            throw new InvariantException('failed creating score token');
        }

        return json_item($scoreToken, 'Solo\ScoreToken');
    }
}
