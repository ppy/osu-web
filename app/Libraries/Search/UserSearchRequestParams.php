<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class UserSearchRequestParams extends UserSearchParams
{
    public function __construct(array $request)
    {
        parent::__construct();

        $this->queryString = presence(trim($request['query'] ?? null));
        $this->from = $this->pageAsFrom(get_int($request['page'] ?? null));
        $this->recentOnly = get_bool($request['recent_only'] ?? null);
    }

    public function isLoginRequired(): bool
    {
        return true;
    }
}
