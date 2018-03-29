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

class ForumSearchRequestParams extends SearchRequestParams
{
    // all public because lazy.

    /** @var int|null */
    public $forumId = null;

    /** @var bool */
    public $includeSubforums = false;

    /** @var string|null */
    public $queryString = null;

    /** @var int|null */
    public $topicId = null;

    /** @var int|null */
    public $username = null;

    public function getCacheKey()
    {
        $vars = get_object_vars($this);
        ksort($vars);

        return 'forum-search:'.json_encode($vars);
    }

    public function isCacheable()
    {
        return false;
    }

    public static function fromArray(array $array)
    {
        $params = new static;

        $params->queryString = $array['query'] ?? null;
        $params->includeSubforums = get_bool($array['includeSubforums'] ?? false);
        $params->username = presence($array['username'] ?? null);
        $params->forumId = get_int($array['forumId'] ?? null);
        $params->topicId = get_int($array['topicId'] ?? null);

        return $params;
    }

    public static function fromRequest(Request $request)
    {
        // TODO
        return static::fromArray([]);
    }
}
