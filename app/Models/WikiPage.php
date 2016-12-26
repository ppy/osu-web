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
    public static function fetch($path)
    {
        return Cache::remember("wiki:{$path}", 60, function () use ($path) {
            try {
                return GitHub::repo()
                    ->contents()
                    ->show('ppy', 'osu-wiki', 'wiki/'.$path);
            } catch (GithubException $e) {
                if ($e->getMessage() === 'Not Found') {
                    throw new GitHubNotFoundException();
                }

                throw $e;
            }
        });
    }

    public static function fetchContent($path)
    {
        return base64_decode(static::fetch($path)['content'], true);
    }

    public static function page($page, $locale)
    {
        return static::fetchContent($page.'/'.$locale.'.md');
    }

    public static function pageLocales($page)
    {
        $locales = [];

        try {
            $contents = static::fetch($page);
        } catch (GitHubNotFoundException $e) {
            return $locales;
        }

        foreach ($contents as $content) {
            $locales[] = str_replace('.md', '', $content['name']);
        }

        return $locales;
    }
}
