<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use Cache;

class Image extends Base
{
    public $path;
    public $url;
    public $referrer;

    // cache variable, filled in value is either null or an array
    private $data = false;

    public function __construct($path, $url = null, $referrer = null)
    {
        $this->path = $this->cleanPath($path);
        $this->url = presence($this->url);
        $this->referrer = presence($this->referrer);
    }

    public function cacheKeyData()
    {
        return 'wiki:image:data:'.$this->path;
    }

    public function data()
    {
        if ($this->data === false) {
            $this->data = Cache::remember($this->cacheKeyData(), static::CACHE_DURATION, function () {
                try {
                    $data = static::fetchContent($this->path);
                    $type = image_type_to_mime_type(
                        read_image_properties_from_string($data)[2] ?? null
                    );

                    return compact('data', 'type');
                } catch (GitHubNotFoundException $e) {
                    if ($this->url !== null && $this->referrer !== null && starts_with($this->url, $this->referrer)) {
                        $newPath = 'shared/'.substr($this->url, strlen($this->referrer));

                        return (new static($newPath))->data();
                    }

                    throw $e;
                }
            });
        }

        return $this->data;
    }
}
