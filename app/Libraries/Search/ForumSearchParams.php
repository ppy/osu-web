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

class ForumSearchParams extends SearchParams
{
    use HasFilteredForums;

    // all public because lazy.

    /** @var int|null */
    public $forumId = null;

    /** @var bool */
    public $includeSubforums = false;

    /** @var string|null */
    public $queryString = null;

    /** {@inheritdoc} */
    public $size = 20;

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
}
