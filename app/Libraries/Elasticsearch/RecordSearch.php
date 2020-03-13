<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
