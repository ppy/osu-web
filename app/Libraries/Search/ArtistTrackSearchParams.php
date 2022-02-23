<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Libraries\Elasticsearch\Sort;
use Ds\Set;

class ArtistTrackSearchParams extends SearchParams
{
    const SORT_FIELD_MAP = [
        'album' => 'album.raw',
        'artist' => 'artist.raw',
        'bpm' => 'bpm',
        'genre' => 'genre.raw',
        'length' => 'length',
        'relevance' => '_score',
        'title' => 'title.raw',
        'update' => 'updated_at',
    ];

    public ?string $album;
    public ?string $artist;
    public ?array $bpm;
    public ?string $genre;
    public bool $isDefaultSort = false;
    public ?array $length;
    public ?string $queryString;
    public string $sortField;
    public string $sortOrder;

    /**
     * {@inheritdoc}
     */
    public function isCacheable(): bool
    {
        return true;
    }

    public function parseSort(?string $sortString, ?bool $isDefaultSort): void
    {
        if ($isDefaultSort !== null) {
            $this->isDefaultSort = $isDefaultSort;
        }

        if (!$this->isDefaultSort) {
            static $validOrders;

            $validOrders ??= new Set(['asc', 'desc']);

            $array = explode('_', $sortString ?? '');
            $this->sortField = $array[0];
            $this->sortOrder = $array[1] ?? '';

            if (
                !array_key_exists($this->sortField, static::SORT_FIELD_MAP)
                || !$validOrders->contains($this->sortOrder)
                || !$this->isSortFieldAvailable($this->sortField)
            ) {
                $this->isDefaultSort = true;
            }
        }

        if ($this->isDefaultSort) {
            $this->sortField = $this->getDefaultSortField();
            $this->sortOrder = 'desc';
        }

        $this->setSorts();
    }

    private function getDefaultSortField(): string
    {
        return $this->isSortFieldAvailable('relevance') ? 'relevance' : 'update';
    }

    private function isSortFieldAvailable(string $sortField): bool
    {
        if ($sortField === 'relevance') {
            return present($this->queryString) || present($this->artist) || present($this->album);
        }

        return true;
    }

    private function setSorts(): void
    {
        $this->sorts = [
            new Sort(static::SORT_FIELD_MAP[$this->sortField], $this->sortOrder),
            new Sort('id', 'asc'),
        ];
    }
}
