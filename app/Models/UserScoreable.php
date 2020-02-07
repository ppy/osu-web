<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Models;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\SearchResponse;
use App\Libraries\Search\BasicSearch;
use App\Models\Score\Best;

trait UserScoreable
{
    public function aggregatedScoresBest(string $mode, int $size): SearchResponse
    {
        $index = config('osu.elasticsearch.prefix')."high_scores_{$mode}";

        $search = new BasicSearch($index, "aggregatedScoresBest_{$mode}");
        $search->connectionName = 'scores';
        $search
            ->size(0) // don't care about hits
            ->query(
                (new BoolQuery)
                    ->filter(['term' => ['user_id' => $this->getKey()]])
                    ->filter(['term' => ['hidden' => 0]])
            )
            ->setAggregations([
                'by_beatmaps' => [
                    'terms' => [
                        'field' => 'beatmap_id',
                        // sort by sub-aggregation max_pp, with score_id as tie breaker
                        'order' => [['max_pp' => 'desc'], ['min_score_id' => 'asc']],
                        'size' => $size,
                    ],
                    'aggs' => [
                        'top_scores' => [
                            'top_hits' => [
                                'size' => 1,
                                'sort' => [['pp' => ['order' => 'desc']]],
                            ],
                        ],
                        // top_hits aggregation is not useable for sorting, so we need an extra aggregation to sort on.
                        'max_pp' => ['max' => ['field' => 'pp']],
                        'min_score_id' => ['min' => ['field' => 'score_id']],
                    ],
                ],
            ]);

        $response = $search->response();
        if ($search->getError() !== null) {
            throw $search->getError();
        }

        return $response;
    }

    public function beatmapBestScoreIds(string $mode, int $size)
    {
        // FIXME: should return some sort of error on error...but the layers above can't handle them.
        $buckets = $this->aggregatedScoresBest($mode, $size)->aggregations('by_beatmaps')['buckets'] ?? [];

        return array_map(function ($bucket) {
            return array_get($bucket, 'top_scores.hits.hits.0._id');
        }, $buckets);
    }

    public function beatmapBestScores(string $mode, int $limit, int $offset = 0, $with = [])
    {
        // aggregations do not support regular pagination.
        // always fetching 100 to cache; we're not supporting beyond 100, either.
        $key = "search-cache:beatmapBestScores:{$this->getKey()}:{$mode}";
        $ids = cache_remember_mutexed($key, config('osu.scores.es_cache_duration'), [], function () use ($mode) {
            return $this->beatmapBestScoreIds($mode, 100);
        }, function () {
            // TODO: propagate a more useful message back to the client
            // for now we just mark the exception as handled.
            return true;
        });

        $ids = array_slice($ids, $offset, $limit);
        $clazz = Best\Model::getClassByString($mode);

        $results = $clazz::whereIn('score_id', $ids)->orderByField('score_id', $ids)->with($with)->get();

        // fill in positions for weighting
        $position = $offset;
        foreach ($results as $result) {
            $result->position = $position;
            $result->weight = pow(0.95, $position);
            $position++;
        }

        return $results;
    }
}
