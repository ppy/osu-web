<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\Utils\ComparatorParam;
use App\Libraries\Elasticsearch\Utils\SearchAfterParam;

class ArtistTrackSearchRequestParams extends ArtistTrackSearchParams
{
    public function __construct(array $rawParams)
    {
        $params = get_params($rawParams, null, [
            'album',
            'artist',
            'bpm:array',
            'exclusive_only:bool',
            'genre',
            'is_default_sort:bool',
            'length:array',
            'limit:int',
            'query',
            'sort',
        ], ['null_missing' => true]);

        $this->queryString = presence(trim($params['query'] ?? ''));
        $this->album = $params['album'];
        $this->artist = $params['artist'];
        [$this->bpm, $this->bpmInput] = ComparatorParam::make($params['bpm'], 'float', 0.005);
        $this->genre = $params['genre'];
        [$this->length, $this->lengthInput] = ComparatorParam::make($params['length'], 'length', 0.5);
        $this->parseSort($params['sort'], $params['is_default_sort']);
        $this->searchAfter = SearchAfterParam::make($this, cursor_from_params($rawParams)); // TODO: enforce value types

        if (isset($params['exclusive_only'])) {
            $this->exclusiveOnly = $params['exclusive_only'];
        }
    }

    public function toArray(): array
    {
        return array_filter([
            'album' => $this->album,
            'artist' => $this->artist,
            'bpm' => $this->bpmInput,
            'exclusive_only' => $this->exclusiveOnly,
            'genre' => $this->genre,
            'is_default_sort' => $this->isDefaultSort,
            'length' => $this->lengthInput,
            'query' => $this->queryString,
            'sort' => "{$this->sortField}_{$this->sortOrder}",
        ], fn ($value) => $value !== null);
    }
}
