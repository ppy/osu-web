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
        $rawParams = request()->all();
        $params = get_params($rawParams, null, [
            'beatmap_hash',
            'ruleset_id:int',
        ]);

        $checks = [
            'beatmap_hash' => fn (string $value): bool => $value === $beatmap->checksum,
            'ruleset_id' => fn (int $value): bool => Beatmap::modeStr($value) !== null,
        ];
        foreach ($checks as $key => $testFn) {
            if (!isset($params[$key])) {
                throw new InvariantException("missing {$key}");
            }
            if (!$testFn($params[$key])) {
                throw new InvariantException("invalid {$key}");
            }
        }

        $build = ClientCheck::findBuild($user, $rawParams);

        try {
            $scoreToken = ScoreToken::create([
                'beatmap_id' => $beatmap->getKey(),
                'build_id' => $build?->getKey() ?? config('osu.client.default_build_id'),
                'ruleset_id' => $params['ruleset_id'],
                'user_id' => $user->getKey(),
            ]);
        } catch (PDOException $e) {
            // TODO: move this to be a validation inside Score model
            throw new InvariantException('failed creating score token');
        }

        return json_item($scoreToken, 'Solo\ScoreToken');
    }
}
