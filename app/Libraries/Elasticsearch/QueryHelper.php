<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use Exception;

class QueryHelper
{
    /**
     * @param array|Queryable $clause
     *
     * @return array
     */
    public static function clauseToArray($clause): array
    {
        if (is_array($clause) && (!empty($clause) && !isset($clause[0]))) {
            return $clause;
        }

        if (is_object($clause) && $clause instanceof Queryable) {
            return $clause->toArray();
        }

        throw new Exception('$clause should be associative array or Queryable.');
    }

    /**
     * Helper method that creates the simple_query_string query.
     *
     * @param string $query The query string.
     * @param array $fields The fields to search; Use an empty array to search all fields.
     *
     * @return array
     */
    public static function queryString(string $query, array $fields = [], string $operator = 'or', float $boost = 1): array
    {
        return [
            'simple_query_string' => [
                'query' => $query,
                'fields' => $fields,
                'default_operator' => $operator,
                'boost' => $boost,
            ],
        ];
    }
}
