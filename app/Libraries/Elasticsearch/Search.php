<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Libraries\Elasticsearch;

use Datadog;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\ElasticsearchException;

abstract class Search extends HasSearch implements Queryable
{
    const HIGHLIGHT_FRAGMENT_SIZE = 50;

    /** @var string */
    public $connectionName = 'default';

    /**
     * A tag to use when logging timing of fetches.
     * FIXME: context-based tagging would be nicer.
     *
     * @var string|null
     */
    public $loggingTag;

    protected $aggregations;
    protected $index;
    protected $queryString;

    private $count;
    private $error;
    private $response;

    public function __construct(string $index, SearchParams $params)
    {
        parent::__construct($params);

        $this->index = $index;
    }

    // for paginator
    abstract public function data();

    /**
     * @return array|Queryable
     */
    abstract public function getQuery();

    public function client() : Client
    {
        return Es::getClient($this->connectionName);
    }

    /**
     * Gets the numner of matches for the query.
     *
     * @return int the number of matches.
     */
    public function count() : int
    {
        // use total from response if response was already fetched.
        if (isset($this->response)) {
            return $this->response->total();
        }

        if (!isset($this->count)) {
            if ($this->params->shouldReturnEmptyResponse()) {
                return $this->count = 0;
            }

            $query = $this->toArray();
            // some arguments need to be stripped from the body as they're not supported by count.
            $body = $query['body'];
            foreach (['from', 'size', 'sort', 'timeout', '_source'] as $key) {
                unset($body[$key]);
            }

            $query['body'] = $body;

            $this->count = $this->client()->count($query)['count'];
        }

        return $this->count;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getPaginator(array $options = [])
    {
        // this does mean it's possible to do something stupid
        // like having $this->params->from start from the middle of a page,
        // but you've got other problems if the paginator is used like that.
        $page = floor($this->params->from / $this->params->size) + 1;

        return new SearchPaginator(
            $this,
            $this->params->size,
            $page,
            $options
        );
    }

    /**
     * Returns if the total number of results found is greater than the allowed limit.
     *
     * @return bool
     */
    public function overLimit()
    {
        return $this->response()->total() > $this->maxResults();
    }

    /**
     * @return SearchResponse
     */
    public function response() : SearchResponse
    {
        if (!isset($this->response)) {
            $this->response = $this->fetch();
        }

        return $this->response;
    }

    public function setAggregations(array $aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        $body = [
            'from' => $this->params->from,
            'size' => $this->getQuerySize(),
            'sort' => array_map(function ($sort) {
                return $sort->toArray();
            }, $this->params->sorts),
            'timeout' => config('osu.elasticsearch.search_timeout'),
        ];

        if (isset($this->highlight)) {
            $body['highlight'] = $this->highlight->toArray();
        }

        if (isset($this->source)) {
            $body['_source'] = $this->source;
        }

        if (isset($this->aggregations)) {
            $body['aggs'] = $this->aggregations;
        }

        $body['query'] = QueryHelper::clauseToArray($this->query ?? $this->getQuery());

        $json = ['body' => $body, 'index' => $this->index];

        if (isset($this->type)) {
            $json['type'] = $this->type;
        }

        return $json;
    }

    /**
     * Returns the user-visible total which can be less than the total number of matching documents.
     *
     * @return int
     */
    public function total()
    {
        return min($this->response()->total(), $this->maxResults());
    }

    private function fetch()
    {
        if ($this->params->shouldReturnEmptyResponse() || $this->isSearchWindowExceeded()) {
            return SearchResponse::empty();
        }

        try {
            return datadog_timing(
                function () {
                    return new SearchResponse($this->client()->search($this->toArray()));
                },
                config('datadog-helper.prefix_web').'.search.fetch',
                $this->getDatadogTags()
            );
        } catch (ElasticsearchException $e) {
            $this->error = $e;
        }

        log_error($this->error);

        if (config('datadog-helper.enabled')) {
            $tags = $this->getDatadogTags();
            $tags['class'] = get_class($this->error);

            Datadog::increment(
                config('datadog-helper.prefix_web').'.search.errors',
                1,
                $tags
            );
        }

        return SearchResponse::failed($this->error);
    }

    private function getDatadogTags()
    {
        return [
            'type' => $this->loggingTag ?? get_class_basename(get_called_class()),
            'index' => $this->index,
        ];
    }

    private function isSearchWindowExceeded()
    {
        return $this->getQuerySize() < 0;
    }
}
