<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class ForumSearchRequestParams extends ForumSearchParams
{
    public function __construct(array $request)
    {
        parent::__construct();

        $this->queryString = presence(trim($request['query'] ?? null));
        $this->from = $this->pageAsFrom(get_int($request['page'] ?? null));
        $this->includeSubforums = get_bool($request['forum_children'] ?? false);
        $this->username = presence(trim($request['username'] ?? null));
        $this->forumId = get_int($request['forum_id'] ?? null);
        $this->topicId = get_int($request['topic_id'] ?? null);
    }

    public function isLoginRequired(): bool
    {
        return true;
    }
}
