<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\Team;

class TeamSearch extends RecordSearch
{
    public function __construct(?TeamSearchParams $params = null)
    {
        parent::__construct(
            Team::esIndexName(),
            $params ?? new TeamSearchParams(),
            Team::class
        );
    }

    public function getQuery()
    {
        static $partialMatchFields = [
            'description',
            'name',
            'name.*',
            'short_name',
            'short_name.*',
        ];

        $value = $this->params->queryString;
        $terms = explode(' ', $value);

        return new BoolQuery()
            ->shouldMatch(1)
            ->should(['term' => ['_id' => ['value' => $value, 'boost' => 100]]])
            ->should(QueryHelper::queryString($value, $partialMatchFields, 'or', 1 / count($terms)))
            ->should(QueryHelper::queryString($value, [], 'and'));
    }

    public function records()
    {
        return parent::records()->loadMissing('leader');
    }
}
