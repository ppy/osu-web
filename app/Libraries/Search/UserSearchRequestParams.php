<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

use Auth;
use App\Libraries\Elasticsearch\Sort;
use Illuminate\Http\Request;

class UserSearchRequestParams extends SearchRequestParams
{
    // all public because lazy.

    public $queryString = null;
    public $recentOnly = false;

    public function __construct(Request $request)
    {
        $this->queryString = $request['query'] ?? null;
        $this->recentOnly = $request['recentOnly'] ?? false;
    }

    public function getCacheKey()
    {
        $vars = get_object_vars($this);
        ksort($vars);

        return 'user-search:'.json_encode($vars);
    }

    public function isCacheable()
    {
        return false;
    }
}
