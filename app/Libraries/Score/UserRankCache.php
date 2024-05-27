<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Score;

use App\Models\BeatmapModeStats;
use Datadog;
use Exception;
use GuzzleHttp\Client;

class UserRankCache
{
    public static function fetch(array $options, int $beatmapId, int $rulesetId, int $score): ?int
    {
        $server = $GLOBALS['cfg']['osu']['scores']['rank_cache']['server_url'];

        if ($server === null || !empty($options['mods']) || ($options['type'] ?? 'global') !== 'global') {
            datadog_increment('user_rank_cached_lookup.miss', ['reason' => 'unsupported_mode']);

            return null;
        }

        $stats = BeatmapModeStats::where([
            'beatmap_id' => $beatmapId,
            'mode' => $rulesetId,
        ])->first();

        if ($stats === null) {
            datadog_increment('user_rank_cached_lookup.miss', ['reason' => 'missing_stats']);

            return null;
        }

        if ($stats->unique_users < $GLOBALS['cfg']['osu']['scores']['rank_cache']['min_users']) {
            datadog_increment('user_rank_cached_lookup.miss', ['reason' => 'not_enough_unique_users']);

            return null;
        }

        try {
            $response = (new Client(['base_uri' => $server]))
                ->request('GET', 'rankLookup', [
                    'connect_timeout' => 1,
                    'timeout' => $GLOBALS['cfg']['osu']['scores']['rank_cache']['timeout'],
                    'query' => compact('beatmapId', 'rulesetId', 'score'),
                ])
                ->getBody()
                ->getContents();
        } catch (Exception $e) {
            log_error($e);
            datadog_increment('user_rank_cached_lookup.miss', ['reason' => 'fetch_failure']);

            return null;
        }

        datadog_increment('user_rank_cached_lookup.hit');

        return 1 + $response;
    }
}
