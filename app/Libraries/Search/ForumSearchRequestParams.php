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

class ForumSearchRequestParams extends ForumSearchParams
{
    public function __construct(Request $request)
    {
        parent::__construct();

        $this->queryString = presence(trim($request['query']));
        $this->from = $this->pageAsFrom(get_int($request['page']));
        $this->includeSubforums = get_bool($request['forum_children']) ?? false;
        $this->username = presence(trim($request['username']));
        $this->forumId = get_int($request['forum_id']);
        $this->topicId = get_int($request['topic_id']);
    }
}
