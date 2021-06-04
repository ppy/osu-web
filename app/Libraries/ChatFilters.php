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

        $cachedFilters = $localCache->get('chat_filters') ?? [];

        if (
            array_key_exists('data', $cachedFilters)
            && array_key_exists('version', $cachedFilters)
            && $cachedFilters['version'] === $localCacheVersion
        ) {
                $this->chatFilters = $cachedFilters['data'];
        }

        if ($this->chatFilters === null) {
            $this->chatFilters = ChatFilter::all();
            $localCache->forever('chat_filters', ['version' => $localCacheVersion, 'data' => $this->chatFilters]);
        }
    }

    public function resetCache()
    {
        cache()->put('chat_filters_local_cache_version', hrtime(true));

        $this->chatFilters = null;
    }
}
