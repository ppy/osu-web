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
        'user' => [
            'type' => UserSearch::class,
            'size' => 6,
        ],
        'beatmapset' => [
            'type' => BeatmapsetSearch::class,
            'size' => 8,
        ],
        'forum_post' => [
            'type' => ForumSearch::class,
            'size' => 8,
        ],
        'wiki_page' => [
            'type' => WikiSearch::class,
            'size' => 8,
        ],
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

    public function visibleSearches()
    {
        $visible = [];
        foreach ($this->searches() as $mode => $search) {
            if ($search !== null && ($this->getMode() === $mode || $this->getMode() === 'all')) {
                $visible[$mode] = $search;
            }
        }

        return $visible;
    }

    public function searches()
    {
        if (!isset($this->searches)) {
            $this->searches = [];
            foreach (static::MODES as $mode => $settings) {
                if ($settings === null) {
                    $this->searches[$mode] = null;
                    continue;
                }

                $class = $settings['type'];
                $options = $class::normalizeParams(['query' => $this->query]);
                $search = new $class($options);

                if ($this->getMode() === 'all') {
                    $search->paginate($settings['size'], 1, ['path' => route('search')]);
                } elseif ($this->getMode() === $mode) {
                    // Don't call paginate if the search isn't for the current mode.
                    // The search is needed for the counts, but we don't need the full response.
                    // Calling paginate will get the full response.
                    $search->paginate(null, null, ['path' => route('search')]);
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
}
