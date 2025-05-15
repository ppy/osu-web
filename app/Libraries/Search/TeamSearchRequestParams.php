<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

class TeamSearchRequestParams extends TeamSearchParams
{
    public function __construct(array $request)
    {
        parent::__construct();

        $params = get_params($request, null, [
            'page:int',
            'query',
            'sort',
        ], ['null_missing' => true]);
        $this->queryString = presence(trim(get_string($params['query'] ?? null) ?? ''));
        $this->page = max($params['page'], 1);

        $this->from = $this->pageAsFrom($this->page);
        $this->parseSort($params['sort']);
    }
}
