<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\ChatFilter;

class ChatFilters
{
    private $chatFilters;

    public function all()
    {
        if (!isset($this->chatFilters)) {
            $this->fetch();
        }

        return $this->chatFilters;
    }

    public function fetch()
    {
        $localCacheVersion = cache()->get('chat_filters_local_cache_version');
        $localCache = cache()->store(config('cache.local'));

        if ($localCacheVersion === null) {
            $localCacheVersion = hrtime(true);
            cache()->forever('chat_filters_local_cache_version', $localCacheVersion);
        }

        $cachedFilters = $localCache->get('chat_filters');

        if ($cachedFilters === null || $cachedFilters['version'] !== $localCacheVersion)
        {
            $cachedFilters = ['version' => $localCacheVersion, 'data' => ChatFilter::all()];
            $localCache->forever('chat_filters', $cachedFilters);
        }

        $this->chatFilters = $cachedFilters['data'];
    }

    public function resetCache()
    {
        cache()->put('chat_filters_local_cache_version', hrtime(true));

        $this->chatFilters = null;
    }
}
