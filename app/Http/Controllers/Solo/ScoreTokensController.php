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
    private static function getBeatmapOrFail($beatmapId): Beatmap
    {
        return Beatmap::scoreable()->findOrFail($beatmapId);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($beatmapId)
    {
        $beatmap = static::getBeatmapOrFail($beatmapId);
        $user = auth()->user();
        $params = request()->all();

        ClientCheck::assert($user, $params);

        try {
            $scoreToken = ScoreToken::create([
                'user_id' => $user->getKey(),
                'beatmap_id' => $beatmap->getKey(),
                'ruleset_id' => get_int($params['ruleset_id'] ?? null),
            ]);
        } catch (PDOException $e) {
            // TODO: move this to be a validation inside Score model
            throw new InvariantException('failed creating score token');
        }

        return json_item($scoreToken, 'Solo\ScoreToken');
    }
}
