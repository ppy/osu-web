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

namespace App\Models\News;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuMarkdownProcessor;
use App\Libraries\OsuWiki;
use Cache;
use Carbon\Carbon;

class Post
{
    // in minutes
    const CACHE_DURATION = 86400;
    const VERSION = 3;

    private $cache = [];
    private $id;
    private $index;

    public static function cacheVersion()
    {
        return static::VERSION.'.'.OsuMarkdownProcessor::VERSION;
    }

    public static function nameFile($id)
    {
        return "{$id}.md";
    }

    public static function nameId($filename)
    {
        return substr($filename, 0, strlen($filename) - strlen('.md'));
    }

    public function __construct($id, $index = null)
    {
        $this->id = $id;
        $this->index = $index;
    }

    public function cacheClear()
    {
        Cache::forget($this->cacheKey());
    }

    public function cacheKey()
    {
        return 'news:post:'.static::cacheVersion().':'.$this->id;
    }

    public function bodyHtml()
    {
        return $this->page()['output'];
    }

    public function createdAt()
    {
        return $this->page()['header']['date'];
    }

    public function disqusId()
    {
        $tumblrUrl = $this->page()['header']['tumblr_url'] ?? null;

        if (!present($tumblrUrl)) {
            $key = $this->getKey();
        } else {
            preg_match('#^.*/post/(?<id>[^/]+)/.*$#', $tumblrUrl, $matches);

            $key = $matches['id'];
        }

        return 'news_'.$key;
    }

    public function editUrl()
    {
        return 'https://github.com/'.OsuWiki::USER.'/'.OsuWiki::REPOSITORY.'/tree/master/news/'.$this->filename();
    }

    public function filename()
    {
        return static::nameFile($this->id);
    }

    // FIXME: the current news use html for first image and thus
    //        not processed by markdown
    public function firstImage()
    {
        return $this->page()['firstImage'];
    }

    public function getKey()
    {
        return $this->id;
    }

    public function index()
    {
        if ($this->index === null) {
            $this->index = Index::index();
        }

        return $this->index;
    }

    public function navIndex()
    {
        if (!array_key_exists('navIndex', $this->cache)) {
            $filename = $this->filename();

            foreach ($this->index() as $i => $entry) {
                if ($entry['name'] === $filename) {
                    $position = $i;
                    break;
                }
            }

            $this->cache['navIndex'] = $position ?? null;
        }

        return $this->cache['navIndex'];
    }

    public function navNewerId()
    {
        $newerEntry = $this->index()[$this->navIndex() - 1] ?? null;

        if ($newerEntry !== null) {
            return static::nameId($newerEntry['name']);
        }
    }

    public function navOlderId()
    {
        $olderEntry = $this->index()[$this->navIndex() + 1] ?? null;

        if ($olderEntry !== null) {
            return static::nameId($olderEntry['name']);
        }
    }

    public function page()
    {
        if ($this->navIndex() === null) {
            return;
        }

        if (!array_key_exists('page', $this->cache)) {
            $page = Cache::get($this->cacheKey());

            if ($page === null) {
                try {
                    $rawPage = OsuWiki::fetchContent('news/'.$this->filename());
                } catch (GitHubNotFoundException $_e) {
                    return;
                }

                $page = OsuMarkdownProcessor::process($rawPage, [
                    'html_input' => 'allow',
                    'path' => route('news.show', $this->id),
                    'block_modifiers' => ['news'],
                ]);

                $page['header']['date'] = Carbon::parse($page['header']['date'] ?? null);

                Cache::put($this->cacheKey(), $page, static::CACHE_DURATION);
            }

            $this->cache['page'] = $page;
        }

        return $this->cache['page'];
    }

    public function title()
    {
        return $this->page()['header']['title'];
    }
}
