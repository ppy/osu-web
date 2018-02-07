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

class Search extends AbstractSearch
{
    // maximum number of total results allowed when not using the scroll API.
    const MAX_RESULTS = 10000;

    protected $index;
    protected $options;

    public function __construct(string $index, array $options = [])
    {
        $this->index = $index;
        $this->options = $options;
    }

    /**
     * @return SearchResponse
     */
    public function response() : SearchResponse
    {
        try {
            return new SearchResponse(Es::search($this->toArray()));
        } catch (NoNodesAvailableException $e) {
            // all servers down
            $error = $e;
        } catch (BadRequest400Exception $e) {
            // invalid query
            $error = $e;
        } catch (Missing404Exception $e) {
            // index is missing ?_?
            $error = $e;
        }

        return SearchResponse::failed($error);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        $json = parent::toArray();
        $json['index'] = $this->index;

        return $json;
    }
}
