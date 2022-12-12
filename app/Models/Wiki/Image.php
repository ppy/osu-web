<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Wiki;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuWiki;
use Exception;
use Illuminate\Contracts\Cache\LockTimeoutException;

class Image implements WikiObject
{
    const CACHE_DURATION = 2 * 60 * 60;

    public $path;

    private $cache;

    public static function lookupForController($path, $url = null, $referrer = null)
    {
        $url = presence($url);
        $referrer = presence($referrer);
        $image = (new static($path))->sync();

        if (!$image->isVisible()) {
            if ($url !== null && $referrer !== null && starts_with($url, $referrer)) {
                $newPath = 'shared/'.substr($url, strlen($referrer));

                return (new static($newPath))->sync();
            }
        }

        return $image;
    }

    public function __construct($path)
    {
        $this->path = OsuWiki::cleanPath($path);
        $this->cache = $this->fetchFromCache();
    }

    public function cacheKey()
    {
        return 'wiki:image:data:v2:'.$this->path;
    }

    public function get()
    {
        return $this->cache['data'] ?? null;
    }

    public function isVisible()
    {
        return $this->get() !== null;
    }

    public function needsSync()
    {
        return $this->cache === null
            || ($this->cache['cached_at'] + static::CACHE_DURATION) < time();
    }

    public function sync($force = false)
    {
        if (!$force && !$this->needsSync()) {
            return $this;
        }

        $cache = cache();
        $cacheKey = $this->cacheKey();
        $lock = $cache->lock($cacheKey.':lock', 300);

        if (!$lock->get()) {
            if ($this->cache !== null) {
                return $this;
            }

            try {
                $lock->block(10);
                $lock->release();
                $this->cache = $this->fetchFromCache();

                return $this->sync($force);
            } catch (LockTimeoutException $_e) {
                // previous attempt is taking too long; try fetching the image anyway
            }
        }

        try {
            $content = OsuWiki::fetchContent('wiki/'.$this->path);
            $type = image_type_to_mime_type(
                read_image_properties_from_string($content)[2] ?? null
            );

            $data = compact('content', 'type');
        } catch (GitHubNotFoundException $e) {
            // do nothing and cache empty data
        } catch (Exception $e) {
            log_error($e);
            $lock->release();

            return $this;
        }

        try {
            $this->cache = [
                'data' => $data ?? null,
                'cached_at' => time(),
            ];
            $cache->put($cacheKey, $this->cache);
        } finally {
            $lock->release();
        }

        return $this;
    }

    private function fetchFromCache(): ?array
    {
        return cache()->get($this->cacheKey());
    }
}
