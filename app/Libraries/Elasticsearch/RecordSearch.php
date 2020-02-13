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

namespace App\Libraries\Elasticsearch;

abstract class RecordSearch extends Search
{
    protected $idField;
    protected $recordType;

    public function __construct(string $index, SearchParams $params, $recordType, $idField = '_id')
    {
        parent::__construct($index, $params);

        $this->idField = $idField;
        $this->recordType = $recordType;
    }

    public function data()
    {
        return $this->records();
    }

    public function records()
    {
        return $this->response()->records()->get();
    }

    public function response(): SearchResponse
    {
        return parent::response()->recordType($this->recordType)->idField($this->idField);
    }
}
