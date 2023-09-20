<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Elasticsearch\Utils;

use App\Exceptions\InvariantException;
use App\Libraries\Elasticsearch\SearchParams;

class SearchAfterParam
{
    /**
     * Extract search_after out of cursor param. Cursor values that are not part of the sort are ignored.
     *
     * The search_after value passed to elasticsearch needs to be the same length as the number of
     * sorts given.
     */
    public static function make(SearchParams $params, $cursor): ?array
    {
        if (!is_array($cursor)) {
            return null;
        }

        $searchAfter = [];
        /** @var Sort $sort */
        foreach ($params->sorts as $sort) {
            $value = $cursor[$sort->field] ?? null;
            if ($value === null) {
                throw new InvariantException('Cursor parameters do not match sort parameters.');
            }

            $searchAfter[] = $value;
        }

        return $searchAfter;
    }
}
