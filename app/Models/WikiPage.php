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

namespace App\Models;

use App\Exceptions\GitHubNotFoundException;
use App\Exceptions\GitHubTooLargeException;
use Cache;
use GitHub;
use Github\Exception\RuntimeException as GithubException;

class WikiPage
{
    const REPOSITORY = 'osu-wiki';
    const USER = 'ppy';

    public static function cleanPath($path)
    {
        return preg_replace('|//+|', '/', trim($path, '/'));
    }

    public static function cacheKey($path)
    {
        return 'wiki:v2:'.static::cleanPath($path);
    }

    public static function fetch($path)
    {
        $cacheKey = static::cacheKey($path);

        return Cache::remember($cacheKey, 60, function () use ($path) {
            try {
                return GitHub::repo()
                    ->contents()
                    ->show(static::USER, static::REPOSITORY, static::cleanPath('wiki/'.$path));
            } catch (GithubException $e) {
                $message = $e->getMessage();

                if ($message === 'Not Found') {
                    throw new GitHubNotFoundException($message);
                } elseif (starts_with($message, 'This API returns blobs up to 1 MB in size.')) {
                    throw new GitHubTooLargeException($message);
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

    public static function fetchImage($path, $url = null, $referrer = null)
    {
        return Cache::remember(static::cacheKey($path), 60, function () use ($path, $url, $referrer) {
            try {
                $data = static::fetchContent($path);
                $type = image_type_to_mime_type(
                    read_image_properties_from_string($data)[2] ?? null
                );

                return compact('data', 'type');
            } catch (GitHubNotFoundException $e) {
                if (present($url) && present($referrer) && starts_with($url, $referrer)) {
                    $newPath = 'shared/'.substr($url, strlen($referrer));

                    return static::fetchImage($newPath);
                }

                throw $e;
            }
        });
    }

    public function __construct($page, $locale = null)
    {
        $this->page = $page;
        $this->locale = $locale;
    }

    public function editUrl()
    {
        return 'https://github.com/'.static::USER.'/'.static::REPOSITORY.'/tree/master/wiki/'.$this->path();
    }

    public function locales()
    {
        $locales = [];

        try {
            $contents = static::fetch($this->page);
        } catch (GitHubNotFoundException $e) {
            return $locales;
        } catch (GitHubTooLargeException $e) {
            return $locales;
        }

        // check if it's a file, not a directory.
        if (isset($contents['name'])) {
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
