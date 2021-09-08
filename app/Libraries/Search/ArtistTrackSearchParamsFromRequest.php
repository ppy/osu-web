<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\Utils\ComparatorParam;
use App\Libraries\Elasticsearch\Utils\SearchAfterParam;

class ArtistTrackSearchParamsFromRequest
{
    public static function fromArray(array $rawParams)
    {
        $paramsArray = get_params($rawParams, null, [
            'album',
            'artist',
            'bpm:array',
            'cursor:array',
            'genre',
            'is_default_sort:bool',
            'length:array',
            'limit:int',
            'query',
            'sort',
        ], ['null_missing' => true]);

        $params = new ArtistTrackSearchParams();

        $params->queryString = presence(trim($paramsArray['query'] ?? ''));
        $params->album = $paramsArray['album'];
        $params->artist = $paramsArray['artist'];
        $params->bpm = ComparatorParam::make($paramsArray['bpm'], 'float', 0.005);
        $params->genre = $paramsArray['genre'];
        $params->length = ComparatorParam::make($paramsArray['length'], 'int', 0.5);
        $params->parseSort($paramsArray['sort'], $paramsArray['is_default_sort']);
        $params->searchAfter = SearchAfterParam::make($params, $paramsArray['cursor']); // TODO: filter cursor param

        return $params;
    }

    public static function toArray(ArtistTrackSearchParams $params)
    {
        return array_filter([
            'album' => $params->album,
            'artist' => $params->artist,
            'bpm' => $params->bpm,
            'genre' => $params->genre,
            'is_default_sort' => $params->isDefaultSort,
            'length' => $params->length,
            'query' => $params->queryString,
            'sort' => "{$params->sortField}_{$params->sortOrder}",
        ], fn ($value) => $value !== null);
    }
}
