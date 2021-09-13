<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Models\ArtistTrack;

class ArtistTrackSearch extends RecordSearch
{
    public function __construct(?ArtistTrackSearchParams $params = null)
    {
        parent::__construct(
            ArtistTrack::esIndexName(),
            $params ?? new ArtistTrackSearchParams(),
            ArtistTrack::class
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        $query = new BoolQuery();

        $this->addQueryStringFilter($query);
        $this->addSimpleFilters($query);
        $this->addTextFilters($query);

        return $query;
    }

    private function addQueryStringFilter($query): void
    {
        $value = $this->params->queryString;

        if ($value === null) {
            return;
        }

        static $partialMatchFields = [
            'album',
            'album.*',
            'album_romanized',
            'album_romanized.*',
            'artist',
            'artist.*',
            'genre',
            'title',
            'title.*',
            'title_romanized',
            'title_romanized.*',
            'version',
            'version.*',
        ];

        $terms = explode(' ', $value);

        $query->must(
            (new BoolQuery())
                ->shouldMatch(1)
                ->should(['term' => ['_id' => ['value' => $value, 'boost' => 100]]])
                ->should(QueryHelper::queryString($value, $partialMatchFields, 'or', 1 / count($terms)))
                ->should(QueryHelper::queryString($value, [], 'and'))
        );
    }

    private function addSimpleFilters(BoolQuery $query): void
    {
        static $filters = [
            'bpm' => ['field' => 'bpm', 'type' => 'range'],
            'length' => ['field' => 'length', 'type' => 'range'],
        ];

        foreach ($filters as $prop => $options) {
            if ($this->params->$prop !== null) {
                $query->filter([$options['type'] => [$options['field'] => $this->params->$prop]]);
            }
        }
    }

    private function addTextFilters($query): void
    {
        static $filters = [
            'album' => ['fields' => ['album', 'album_romanized']],
            'artist' => ['fields' => ['artist']],
            'genre' => ['fields' => ['genre']],
        ];

        foreach ($filters as $prop => $filter) {
            $value = $this->params->$prop;

            if ($value === null) {
                continue;
            }

            $subQuery = (new BoolQuery())->shouldMatch(1);
            $searchFields = [];

            foreach ($filter['fields'] as $field) {
                $searchFields[] = $field;
                $searchFields[] = "{$field}.*";
                $subQuery->should(['term' => ["{$field}.raw" => ['value' => $value, 'boost' => 100]]]);
            }
            $subQuery->should(QueryHelper::queryString($value, $searchFields, 'and'));
            $query->must($subQuery);
        }
    }
}
