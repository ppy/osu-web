<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Score;

use App\Exceptions\InvariantException;
use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;

class UserRank
{
    public static function getCount(ScoreSearchParams $params): int
    {
        $params->setSort(null);
        $search = new ScoreSearch($params);

        $search->size(0);
        static $aggName = 'by_user';
        $search->setAggregations([$aggName => ['cardinality' => [
            'field' => 'user_id',
        ]]]);
        $response = $search->response();
        $search->assertNoError();

        return $response->aggregations($aggName)['value'];
    }

    public static function getRank(ScoreSearchParams $params): int
    {
        if ($params->beforeTotalScore === null && $params->beforeScore === null) {
            throw new InvariantException('beforeScore or beforeTotalScore must be specified');
        }

        return 1 + static::getCount($params);
    }
}
