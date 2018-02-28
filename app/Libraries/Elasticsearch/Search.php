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

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Elasticsearch\Common\Exceptions\NoNodesAvailableException;

class Search implements Queryable
{
    use HasSearch;

    // maximum number of total results allowed when not using the scroll API.
    const MAX_RESULTS = 10000;

    protected $index;
    protected $options;

    private $error;
    private $response;

    public function __construct(string $index, array $options = [])
    {
        $this->index = $index;
        $this->options = $options;
    }

    public function getError()
    {
        return $this->error;
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

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        $pageParams = $this->getPaginationParams();

        $body = [
            'from' => $pageParams['from'],
            'size' => $pageParams['size'],
            'sort' => $this->sort,
        ];

        if (isset($this->highlight)) {
            $body['highlight'] = $this->highlight->toArray();
        }

        if (isset($this->source)) {
            $body['_source'] = $this->source;
        }

        $body['query'] = QueryHelper::clauseToArray($this->query);

        $json = ['body' => $body, 'index' => $this->index];

        if (isset($this->type)) {
            $json['type'] = $this->type;
        }

        return $json;
    }

    private function fetch()
    {
        try {
            return new SearchResponse(Es::search($this->toArray()));
        } catch (NoNodesAvailableException $e) {
            // all servers down
            $this->error = $e;
        } catch (BadRequest400Exception $e) {
            // invalid query
            $this->error = $e;
        } catch (Missing404Exception $e) {
            // index is missing ?_?
            $this->error = $e;
        }

        return SearchResponse::failed();
    }
}
