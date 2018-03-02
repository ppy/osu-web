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

namespace App\Libraries;

use App\Models\Beatmapset;
use App\Models\User;
use App\Models\Wiki\Page as WikiPage;
use Datadog;
use Illuminate\Pagination\LengthAwarePaginator;

class Search
{
    const MODES = [
        'all' => null,

        // also display order
        'user' => User::class,
        'beatmapset' => Beatmapset::class,
        'forum_post' => ForumSearch::class,
        'wiki_page' => WikiPage::class,
    ];

    const DEFAULT_MODE = 'all';

    private $cache = [];
    public $params;
    public $user;
    public $requestedLocale;

    public function __construct($params)
    {
        $this->mode = array_pull($params, 'mode');
        if (!array_key_exists($this->mode, static::MODES)) {
            $this->mode = static::DEFAULT_MODE;
        }

        $this->user = array_pull($params, 'user');
        $this->params = $params;
    }

    public function all()
    {
        $all = [];

        foreach (static::MODES as $mode => $_class) {
            $result = $this->search($mode);

            if ($result !== null) {
                $all[$mode] = $result;
            }
        }

        return $all;
    }

    public function hasQuery()
    {
        return mb_strlen(trim($this->params['query'] ?? null)) >= config('osu.search.minimum_length');
    }

    public function paginate($mode)
    {
        return new LengthAwarePaginator(
            $this->search($mode)['data'],
            $this->search($mode)['total'],
            $this->search($mode)['params']['limit'],
            $this->search($mode)['params']['page'],
            ['path' => route('search')]
        );
    }

    public function search($mode)
    {
        $class = static::MODES[$mode];

        if ($class === null) {
            return;
        }

        if ($this->mode !== static::DEFAULT_MODE && $this->mode !== $mode) {
            return;
        }

        $key = __FUNCTION__.':'.$mode;

        if (!array_key_exists($key, $this->cache)) {
            $startTime = microtime(true);

            $this->cache[$key] = $class::search($this->params);

            if (config('datadog-helper.enabled') && $mode !== 'beatmapset') {
                $searchDuration = microtime(true) - $startTime;
                Datadog::microtiming(config('datadog-helper.prefix_web').'.search', $searchDuration, 1, ['type' => $mode]);
            }
        }

        return $this->cache[$key];
    }

    public function urlParams($newParams = [])
    {
        $newParams['mode'] ?? ($newParams['mode'] = $this->mode);

        if ($newParams['mode'] === static::DEFAULT_MODE) {
            $newParams['mode'] = null;
            $newParams['limit'] = null;
        }

        return array_merge($this->params, $newParams);
    }

    public function url($newParams = [])
    {
        return route('search', $this->urlParams($newParams));
    }
}
