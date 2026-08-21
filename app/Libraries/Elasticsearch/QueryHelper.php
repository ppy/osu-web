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
     * Tokenises and parses a search query into include and exclude portions.
     * Multiple whitespaces are not preserved and treated as a single whitespace.
     */
    public static function tokenise(string $query): array
    {
        $query = preg_replace('/[\s\pZ\pC]+/u', ' ', $query);
        $parts = [
            'exclude' => [],
            'include' => [],
        ];

        $mode = 'include';
        $phrase = '';
        $quoteOpened = false;
        $quoteClosed = false;

        $token = strtok($query, ' ');
        while ($token !== false) {
            $word = $token;
            if ($phrase === '') {
                $mode = str_starts_with($token, '-') ? 'exclude' : 'include';
                $word = ltrim($token, '-');
            }

            if ($quoteOpened) {
                $phrase .= ' ';
            }

            $phrase .= $word;

            if (!$quoteOpened) {
                $quoteOpened = str_starts_with($word, '"');
            }
            if ($quoteOpened) {
                $quoteClosed = $phrase !== '"' && str_ends_with($word, '"');
            }

            // don't push if still looking for closing quote
            if (!($quoteOpened && !$quoteClosed)) {
                $parts[$mode][] = $phrase;
                $phrase = '';
                $quoteOpened = false;
                $quoteClosed = false;
            }

            $token = strtok(' ');
        }

        // push remainder if missing closing quote.
        if ($phrase !== '') {
            $parts[$mode][] = $phrase;
        }

        return $parts;
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
