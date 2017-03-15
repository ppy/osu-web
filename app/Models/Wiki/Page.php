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
use App\Exceptions\GitHubTooLargeException;
use Cache;

class Page extends Base
{
    public $locale;
    private $locales;

    // cache variable, filled in value is either null or a string
    private $page = false;

    public function __construct($path, $locale)
    {
        $this->path = $this->cleanPath($path);
        $this->pagePath = $this->path.'/'.$locale.'.md';
        $this->locale = $locale;
    }

    public function cacheKeyLocales()
    {
        return 'wiki:page:locales:'.$this->path;
    }

    public function cacheKeyPage()
    {
        return 'wiki:page:page:'.$this->pagePath;
    }

    public function editUrl()
    {
        return 'https://github.com/'.static::USER.'/'.static::REPOSITORY.'/tree/master/wiki/'.$this->pagePath;
    }

    public function fetchLocales()
    {
        $locales = [];

        try {
            $data = static::fetch($this->path);
        } catch (GitHubNotFoundException $e) {
            return $locales;
        } catch (GitHubTooLargeException $e) {
            return $locales;
        }

        // check if it's a file, not a directory.
        if (isset($data['name'])) {
            return $locales;
        }

        foreach ($data as $entry) {
            $hasMatch = preg_match(
                '/^(\w{2}(?:-\w{2})?)\.md$/',
                $entry['name'],
                $matches
            );

            if ($hasMatch === 1) {
                $locales[] = $matches[1];
            }
        }

        return $locales;
    }

    public function locales()
    {
        if ($this->locales === null) {
            $this->locales = Cache::remember(
                $this->cacheKeyLocales(),
                static::CACHE_DURATION,
                function () {
                    return $this->fetchLocales();
                }
            );
        }

        return $this->locales;
    }

    public function page()
    {
        if ($this->page === false) {
            $this->page = Cache::remember(
                $this->cacheKeyPage(),
                static::CACHE_DURATION,
                function () {
                    try {
                        $page = static::fetchContent($this->pagePath);
                    } catch (GitHubNotFoundException $_e) {
                        return;
                    }
                    // indexing goes here

                    return $page;
                }
            );
        }

        return $this->page;
    }

    public function refresh()
    {
        Cache::forget($this->cacheKeyPage());
        Cache::forget($this->cacheKeyLocales());
    }
}
