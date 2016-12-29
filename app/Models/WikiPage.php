<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

namespace App\Models;

use App\Exceptions\GitHubNotFoundException;
use Cache;
use GitHub;
use Github\Exception\RuntimeException as GithubException;

class WikiPage
{
    const REPOSITORY = 'osu-wiki';
    const USER = 'ppy';

    public static function cacheKey($path)
    {
        return 'wiki:'.preg_replace('|//+|', '/', trim($path, '/'));
    }

    public static function fetch($path)
    {
        $cacheKey = static::cacheKey($path);

        return Cache::remember($cacheKey, 60, function () use ($path) {
            try {
                return GitHub::repo()
                    ->contents()
                    ->show(static::USER, static::REPOSITORY, 'wiki/'.$path);
            } catch (GithubException $e) {
                if ($e->getMessage() === 'Not Found') {
                    throw new GitHubNotFoundException();
                }

                throw $e;
            }
        });
    }

    private $page;
    private $locale;
    private $markdown;

    public static function fetchContent($path)
    {
        return base64_decode(static::fetch($path)['content'], true);
    }

    public function __construct($page, $locale = null)
    {
        $this->page = $page;
        $this->locale = $locale;
    }

    public function editUrl()
    {
        return 'https://github.com/'.static::USER.'/'.static::REPOSITORY.'/tree/master/wiki/'.$this->page;
    }

    public function locales()
    {
        $locales = [];

        try {
            $contents = static::fetch($this->page);
        } catch (GitHubNotFoundException $e) {
            return $locales;
        }

        foreach ($contents as $content) {
            $hasMatch = preg_match(
                '/^(\w{2}(?:-\w{2})?)\.md$/',
                $content['name'],
                $matches
            );

            if ($hasMatch === 1) {
                $locales[] = $matches[1];
            }
        }

        return $locales;
    }

    public function markdown()
    {
        return static::fetchContent($this->path());
    }

    public function path($locale = null)
    {
        return $this->page.'/'.($locale ?? $this->locale).'.md';
    }

    public function refresh()
    {
        Cache::forget(static::cacheKey($this->page));

        $locales = $this->locales();
        foreach ($locales as $locale) {
            $path = $this->path($locale);

            Cache::forget(static::cacheKey($path));
        }
    }
}
