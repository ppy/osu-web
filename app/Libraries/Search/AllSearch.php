<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use App\Transformers\UserCompactTransformer;
use App\Transformers\WikiPageTransformer;
use stdClass;

class AllSearch extends MultiSearch
{
    const TRANSFORMERS = [
        'user' => [
            'class' => UserCompactTransformer::class,
            'includes' => [],
        ],

        'wiki_page' => [
            'class' => WikiPageTransformer::class,
            'includes' => [],
        ],
    ];

    public function showMore()
    {
        return $this->getMode() === 'all';
    }

    public function toJson()
    {
        $res = new stdClass();
        $searchMode = $this->getMode();
        $returnAllMode = $searchMode === 'all';

        foreach ($this->searches() as $mode => $search) {
            if ($search === null || (!$returnAllMode && $searchMode !== $mode)) {
                continue;
            }

            $transformer = static::TRANSFORMERS[$mode] ?? null;

            if ($transformer === null) {
                continue;
            }

            $res->{$mode} = [
                'data' => json_collection($search->data(), new $transformer['class'](), $transformer['includes']),
                'total' => $search->count(),
            ];
        }

        return $res;
    }

    public function visibleSearches()
    {
        $visible = [];
        foreach ($this->searches() as $mode => $search) {
            if ($search !== null && ($this->getMode() === $mode || $this->getMode() === 'all')) {
                $visible[$mode] = $search;
            }
        }

        return $visible;
    }
}
