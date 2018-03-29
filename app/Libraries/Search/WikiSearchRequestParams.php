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

use Illuminate\Http\Request;

class WikiSearchRequestParams extends SearchRequestParams
{
    // all public because lazy.

    /** @var string|null */
    public $queryString = null;

    /** @var string|null */
    public $locale = null;

    public function getCacheKey()
    {
        $vars = get_object_vars($this);
        ksort($vars);

        return 'wiki-search:'.json_encode($vars);
    }

    public function isCacheable()
    {
        return false;
    }

    public static function fromArray(array $array)
    {
        $params = new static;
        $params->queryString = presence($array['query'] ?? null);
        $params->locale = $array['locale'] ?? null;

        return $params;
    }

    // implemented for completeness.
    public static function fromRequest(Request $request)
    {
        return static::fromArray([
            'query' => trim(request('query')),
            'locale' => request('locale')
        ]);
    }
}
