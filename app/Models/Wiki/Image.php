<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models\Wiki;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuWiki;
use Exception;

class Image implements WikiObject
{
    // in seconds
    const CACHE_DURATION = 7200;

    public $path;
    public $url;
    public $referrer;

    private $cache = [];

    public function __construct($path, $url = null, $referrer = null)
    {
        $this->path = OsuWiki::cleanPath($path);
        $this->url = presence($this->url);
        $this->referrer = presence($this->referrer);
    }

    public function cacheKeyData()
    {
        return 'wiki:image:data:'.$this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function get($synchronous = false)
    {
        if (!array_key_exists('data', $this->cache)) {
            $this->cache['data'] = cache_remember_with_fallback($this->cacheKeyData(), static::CACHE_DURATION, function () {
                try {
                    $data = OsuWiki::fetchContent('wiki/'.$this->path);
                    $type = image_type_to_mime_type(
                        read_image_properties_from_string($data)[2] ?? null
                    );

                    return compact('data', 'type');
                } catch (Exception $e) {
                    if ($e instanceof GitHubNotFoundException) {
                        // try alternative path
                        if (
                            $this->url !== null &&
                            $this->referrer !== null &&
                            starts_with($this->url, $this->referrer)
                        ) {
                            $newPath = 'shared/'.substr($this->url, strlen($this->referrer));

                            return (new static($newPath))->get();
                        }
                        // return nothing otherwise
                    } else {
                        // throw everything else
                        throw $e;
                    }
                }
            });
        }

        return $this->cache['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function forget($synchronous = false)
    {
        cache_forget_with_fallback($this->cacheKeyData());
        unset($this->cache['data']);
    }
}
