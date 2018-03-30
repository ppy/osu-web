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

use App\Libraries\Elasticsearch\SearchParams;
use App\Models\User;
use Illuminate\Http\Request;

class ForumSearchParams extends SearchParams
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

    /**
     * {@inheritdoc}
     */
    public function getCacheKey() : string
    {
        $vars = get_object_vars($this);
        ksort($vars);

        return 'forum-search:'.json_encode($vars);
    }

     /**
     * {@inheritdoc}
     */
    public function isCacheable() : bool
    {
        return false;
    }

    public static function fromArray(array $array)
    {
        $params = new static;

        $params->queryString = $array['query'] ?? null;
        $params->page = $array['page'] ?? null;
        $params->size = $array['size'] ?? null;
        $params->sort = $array['sort'] ?? null;
        $params->includeSubforums = get_bool($array['includeSubforums'] ?? false);
        $params->username = presence($array['username'] ?? null);
        $params->forumId = get_int($array['forumId'] ?? null);
        $params->topicId = get_int($array['topicId'] ?? null);

        return $params;
    }

    public static function fromRequest(Request $request, ?User $user = null)
    {
        $params = new static;

        $params->queryString = presence(trim($request['query']));
        $params->page = get_int($request['page']);
        $params->includeSubforums = get_bool($request['forum_children']) ?? false;
        $params->username = presence(trim($request['username']));
        $params->forumId = get_int($request['forum_id']);
        $params->topicId = get_int($request['topic_id']);

        return $params;
    }
}
