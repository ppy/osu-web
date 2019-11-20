<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models\Wiki;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuWiki;
use Exception;

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
        $this->cache = cache()->get($this->cacheKey());
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

        $lock = cache()->lock($this->cacheKey().':lock', 300);

        if (!$lock->get()) {
            return $this;
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

            return $this;
        } finally {
            $lock->release();
        }

        $this->cache = [
            'data' => $data ?? null,
            'cached_at' => time(),
        ];
        cache()->put($this->cacheKey(), $this->cache);

        return $this;
    }
}
