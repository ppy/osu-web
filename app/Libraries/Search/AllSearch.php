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

namespace App\Libraries\Search;

use App\Models\Beatmapset;
use App\Models\User;

class AllSearch
{
    const MODES = [
        'all' => null,
        'user' => UserSearch::class,
        'beatmapset' => BeatmapsetSearch::class,
        'forum_post' => ForumSearch::class,
        'wiki_page' => WikiSearch::class,
    ];

    public $params;
    public $user;
    public $requestedLocale;

    private $cache = [];

    private $options = [];
    private $searches;

    public function __construct(?string $query = null, array $options = [])
    {
        $this->query = trim($query);
        $this->options = $options;
    }

    public function getMode()
    {
        return $this->options['mode'] ?? 'all';
    }

    public function currentQuery()
    {
        return $this->query;
    }

    public function searches()
    {
        if (!isset($this->searches)) {
            $this->searches = [];
            foreach (static::MODES as $mode => $class) {
                if ($class === null) {
                    $this->searches[$mode] = null;
                    continue;
                }

                $options = $class::normalizeParams(['query' => $this->query]);
                $search = new $class(
                    array_merge($options, ['query' => $this->query])
                );

                if ($this->getMode() === 'all') {
                    $search->paginate(6, 1, ['path' => route('search')])
                        ->appends(request()->query());
                } else {
                    $search->paginate(10, null, ['path' => route('search')])
                        ->appends(request()->query());
                }

                $this->searches[$mode] = $search;
            }
        }

        return $this->searches;
    }

    public function hasQuery()
    {
        return mb_strlen($this->query) >= config('osu.search.minimum_length');
    }

    public static function counts($query)
    {
        $searches = [];
        foreach (static::MODES as $mode => $class) {
            if ($class === null) {
                $searches[$mode] = 0;
                continue;
            }

            $options = $class::normalizeParams(['query' => $query]);
            $searches[$mode] = (new $class($options))->count();
        }

        return $searches;
    }
}
