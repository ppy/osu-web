<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

class WikiSearchRequestParams extends WikiSearchParams
{
    public function __construct(array $request)
    {
        parent::__construct();

        $this->queryString = trim($request['query'] ?? null);
        $this->locale = $request['locale'] ?? null;
        $this->page = get_int($request['page'] ?? null);
        $this->from = $this->pageAsFrom($this->page);
    }
}
