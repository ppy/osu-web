<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Models\User;

class PostSearchRequestParams extends PostSearchParams
{
    public function __construct(array $request, User $user)
    {
        parent::__construct();

        $this->queryString = presence(trim($request['query'] ?? null));
        $this->from = $this->pageAsFrom(get_int($request['page'] ?? null));
        $this->userId = $user->getKey();
        $this->forumId = get_int($request['forum_id'] ?? null);
        $this->includeSubforums = get_bool($request['forum_children'] ?? null);
    }

    public function isLoginRequired(): bool
    {
        return true;
    }
}
