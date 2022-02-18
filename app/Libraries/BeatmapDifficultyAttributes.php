<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use GuzzleHttp\Client;

class BeatmapDifficultyAttributes
{
    public static function get(int $beatmapId, int $rulesetId, array $mods)
    {
        $response = (new Client(['base_uri' => config('osu.beatmaps.difficulty_cache.server_url')]))
            ->request('POST', 'attributes', [
                'connect_timeout' => 1,
                'json' => [
                    'beatmap_id' => $beatmapId,
                    'mods' => $mods,
                    'ruleset_id' => $rulesetId,
                ],
            ])
            ->getBody()
            ->getContents();

        return json_decode($response, true);
    }
}
