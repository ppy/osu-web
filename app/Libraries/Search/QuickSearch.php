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
use App\Models\Wiki\Page as WikiPage;
use Datadog;

class QuickSearch
{
    const MODES = [
        'user' => UserSearch::class,
        'beatmapset' => BeatmapsetSearch::class
    ];

    private $pageSize;
    private $query;

    public function __construct($query, int $pageSize = 5)
    {
        $this->pageSize = $pageSize;
        $this->query = trim($query);
    }

    public function currentQuery()
    {
        return $this->query;
    }

    public function hasQuery()
    {
        return mb_strlen($this->query) >= config('osu.search.minimum_length');
    }

    public function search($mode)
    {
        // TODO: force class name to be passed in? but it's kind of shit from the blades...
        $class = static::MODES[$mode];

        return $class::search(['query' => $this->query])
            ->paginate($this->pageSize, 1, ['path' => route('search')]);
    }
}
