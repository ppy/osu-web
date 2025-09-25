<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Elasticsearch;

use App\Exceptions\InvalidCursorException;
use App\Exceptions\InvariantException;
use App\Exceptions\SilencedException;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Curl\OperationTimeoutException;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use Elasticsearch\Common\Exceptions\RuntimeException;

abstract class Search extends HasSearch implements Queryable
{
    const HIGHLIGHT_FRAGMENT_SIZE = 50;

    /** @var string */
    public $connectionName = 'default';

    /**
     * A tag to use when logging timing of fetches.
     * FIXME: context-based tagging would be nicer.
     */
    public ?string $loggingTag;

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

    public function assertNoError(): void
    {
        if ($this->error !== null) {
            throw $this->error;
        }
    }

    // for paginator
    abstract public function data();

    /**
     * @return array|Queryable
     */
    abstract public function getQuery();

    public function client(): Client
    {
        return Es::getClient($this->connectionName);
    }

    /**
     * Gets the numner of matches for the query.
     *
     * @return int the number of matches.
     */
    public function count(): int
    {
        // use total from response if response was already fetched.
        if (isset($this->response)) {
            return $this->response->total();
        }

        if (!isset($this->count)) {
            if ($this->params->shouldReturnEmptyResponse()) {
                return $this->count = 0;
            }

            $result = $this->runQuery(
                'count',
                function () {
                    return $this->client()->count($this->toCountRequestParams())['count'];
                }
            );

            $this->count = $this->error === null ? $result : 0;
        }

        return $this->count;
    }

    /**
     * Sends a query to delete all documents in the index and waits for a refresh.
     */
    public function deleteAll(): void
    {
        // Force a refresh to flush pending index writes. Should be fine since this function is only used during testing.
        $this->client()->indices()->refresh(['index' => $this->index]);
        $this->client()->deleteByQuery([
            'body' => ['query' => ['match_all' => (object) []]],
            'index' => $this->index,
            'refresh' => true,
        ]);
    }

    public function fail($error = null)
    {
        $this->error = $error; // for the message.
        $this->response = SearchResponse::failed($error);
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

    public function getSortCursor(): ?array
    {
        $requested = $this->params->size;
        $received = $this->response()->count();
        $total = $this->response()->total();

        if ($received === $requested && $received < $total) {
            $last = array_last($this->response()->hits());
            if (array_key_exists('sort', $last)) {
                return array_combine(
                    array_map(fn ($sort) => $sort->field, $this->params->sorts),
                    $last['sort'],
                );
            }
        }

        return null;
    }

    public function isLoginRequired(): bool
    {
        return $this->params->isLoginRequired();
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
     * Allow documents to be immediately searchable (mainly for testing).
     */
    public function refresh(): void
    {
        $this->client()->indices()->refresh(['index' => $this->index]);
    }

    public function response(): SearchResponse
    {
        if (!isset($this->response)) {
            $this->response = $this->fetch();
        }

        return $this->response;
    }

    /**
     * @return $this
     */
    public function searchAfter(?array $searchAfter)
    {
        // FIXME: The values should be sanitised. The count and type must match sort options.
        $this->params->searchAfter = $searchAfter;
        $this->response = null;

        return $this;
    }

    public function setAggregations(array $aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $body = [
            'size' => $this->getQuerySize(), // TODO: this probably shouldn't be calculated if search_after is used.
            'sort' => array_map(function ($sort) {
                return $sort->toArray();
            }, $this->params->sorts),
            'timeout' => $GLOBALS['cfg']['osu']['elasticsearch']['search_timeout'],
        ];

        if (isset($this->params->searchAfter)) {
            $body['search_after'] = $this->params->searchAfter;
        } else {
            $body['from'] = $this->params->from;
        }

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

        $result = $this->runQuery(
            'fetch',
            function () {
                return new SearchResponse($this->client()->search($this->toArray()));
            }
        );

        return $this->error === null ? $result : SearchResponse::failed($this->error);
    }

    private function getDatadogTags()
    {
        return [
            'type' => $this->loggingTag ?? get_class_basename(get_called_class()),
            'index' => $this->index,
        ];
    }

    private function handleError(ElasticsearchException $e, string $operation)
    {
        if ($e instanceof RuntimeException && $e->getMessage() === 'Failed to JSON encode: Inf and NaN cannot be JSON encoded') {
            $e = new InvariantException('Invalid search parameter.');
        } else {
            $err = json_decode($e->getMessage(), true);

            if (is_array($err) && str_starts_with($err['error']['caused_by']['reason'] ?? '', 'Failed to parse search_after value for field ')) {
                $e = new InvalidCursorException();
            }
        }

        $tags = $this->getDatadogTags();
        $tags['class'] = get_class($e);

        if (!($e instanceof OperationTimeoutException || $e instanceof SilencedException)) {
            app('sentry')->captureException($e);
        }

        datadog_increment('search.errors', $tags);

        return $e;
    }

    private function isSearchWindowExceeded()
    {
        return $this->getQuerySize() < 0;
    }

    private function toCountRequestParams(): array
    {
        $params = $this->toArray();
        // some arguments need to be stripped from the body as they're not supported by count.
        foreach (['from', 'highlight', 'search_after', 'size', 'sort', 'timeout', '_source'] as $key) {
            unset($params['body'][$key]);
        }

        return $params;
    }

    /**
     * Wrapper function to run a query with timing and error reporting.
     *
     * @param string $operation
     * @param callable $callable
     *
     * @return mixed Returns whatever $callable returns, void with $this->error set on error.
     */
    private function runQuery(string $operation, callable $callable)
    {
        $this->error = null;

        try {
            return datadog_timing(
                $callable,
                $GLOBALS['cfg']['datadog-helper']['prefix_web'].'.search.'.$operation,
                $this->getDatadogTags()
            );
        } catch (ElasticsearchException $e) {
            $this->error = $this->handleError($e, $operation);
        }
    }
}
