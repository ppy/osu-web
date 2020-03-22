<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchResponse;
use Cache;

/**
 * Version of BeatmapsetSearch that caches response() if cacheable and doesn't include source in the response.
 */
class BeatmapsetSearchCached extends BeatmapsetSearch
{
    public function response(): SearchResponse
    {
        $this->source(false);

        if (!$this->params->isCacheable()) {
            return parent::response();
        }

        $key = "es-response:{$this->params->getCacheKey()}";

        $value = Cache::get($key);
        if ($value !== null) {
            return $value;
        }

        $value = parent::response();

        if ($this->getError() === null) {
            Cache::put($key, $value, config('osu.beatmapset.es_cache_duration'));
        }

        return $value;
    }
}
