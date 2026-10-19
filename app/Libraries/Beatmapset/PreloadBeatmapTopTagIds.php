<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Beatmapset;

use App\Models\Beatmap;
use App\Models\Beatmapset;

class PreloadBeatmapTopTagIds
{
    public static function handle(Beatmapset $beatmapset): void
    {
        $beatmapIds = $beatmapset->beatmaps->pluck('beatmap_id')->all();
        // may happen in test
        if (count($beatmapIds) === 0) {
            return;
        }

        $allDataByBeatmapId = array_combine(
            $beatmapIds,
            \LaravelRedis::connection('cache')->mget(prefix_strings(Beatmap::TOP_TAG_IDS_CACHE_PREFIX, $beatmapIds)),
        );

        foreach ($beatmapset->beatmaps as $beatmap) {
            $data = $allDataByBeatmapId[$beatmap->getKey()];
            if ($data === null) {
                $beatmap->topTagIds(false);
            } else {
                $beatmap->setMemoize('topTagIds', unserialize($data));
            }
        }
    }
}
