<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\SearchParams;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Beatmap;
use App\Models\User;
use Illuminate\Http\Request;

class BeatmapsetSearchParams extends SearchParams
{
    // all public because lazy.

    /** @var array */
    public $extra = [];

    /** @var int|null */
    public $genre = null;

    /** @var bool */
    public $includeConverts = false;

    /** @var int|null */
    public $language = null;

    /** @var int|null */
    public $mode = null;

    /** @var string|null */
    public $queryString = null;

    /** @var array */
    public $rank = [];

    /** @var bool */
    public $showRecommended = false;

    /** @var int */
    public $status = 0;

    /** @var User|null */
    public $user = null;

    /**
     * {@inheritdoc}
     */
    public function getCacheKey() : string
    {
        $vars = get_object_vars($this);
        unset($vars['user']);
        ksort($vars);

        return 'beatmapset-search:'.json_encode($vars);
    }

    /**
     * {@inheritdoc}
     */
    public function isCacheable() : bool
    {
        return !(
            present($this->queryString)
            || !empty($this->rank)
            || in_array($this->status, [2, 6], true) // favourites, my maps.
            || $this->showRecommended
        );
    }

    public static function fromArray(array $array)
    {
        $params = new static;
        $params->queryString = $array['query'] ?? null;
        $params->page = $array['page'] ?? null;
        $params->size = $array['size'] ?? null;
        $params->sort = $array['sort'] ?? null;

        return $params;
    }

    public static function fromRequest(Request $request, ?User $user = null)
    {
        static $validExtras = ['video', 'storyboard'];
        static $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];

        $params = new static;

        $params->user = $user;
        $params->page = get_int($request['page']) ?? 1;

        if ($params->user !== null) {
            $params->queryString = es_query_escape_with_caveats($request['q'] ?? $request['query']);
            $params->status = get_int($request['s']) ?? 0;
            $params->genre = get_int($request['g']);
            $params->language = get_int($request['l']);
            $params->extra = array_intersect(
                explode('.', $request['e']),
                $validExtras
            );

            $params->mode = get_int($request['m']);
            if (!in_array($params->mode, Beatmap::MODES, true)) {
                $params->mode = null;
            }

            $generals = explode('.', $request['c']) ?? [];
            $params->includeConverts = in_array('converts', $generals, true);
            $params->showRecommended = in_array('recommended', $generals, true);

            if ($params->user->isSupporter()) {
                $params->rank = array_intersect(
                    explode('.', $request['r'] ?? null),
                    $validRanks
                );
            }
        }

        $sort = explode('_', $request['sort']);
        $params->sort = static::normalizeSort(
            [static::remapSortField(new Sort($sort[0] ?? null, $sort[1] ?? null))]
        );

        return $params;
    }

    /**
     * Generate sort parameters for the elasticsearch query.
     */
    private static function normalizeSort($sorts)
    {
        // additional options
        static $orderOptions = [
            'difficulties.difficultyrating' => [
                'asc' => ['mode' => 'min'],
                'desc' => ['mode' => 'max'],
            ],
        ];

        if ($sorts === []) {
            return [];
        }

        $newSort = [];
        foreach ($sorts as $sort) {
            $options = ($orderOptions[$sort->field] ?? [])[$sort->order] ?? [];
            if ($options !== []) {
                $sort->mode = $options['mode'];
            }

            $newSort[] = $sort;

            if ($sort->field === 'nominations') {
                $newSort[] = new Sort('hype', $sort->order);
            }
        }

        return $newSort;
    }

    private static function remapSortField(Sort $sort)
    {
        static $fields = [
            'artist' => 'artist.raw',
            'creator' => 'creator.raw',
            'difficulty' => 'difficulties.difficultyrating',
            'nominations' => 'nominations',
            'plays' => 'play_count',
            'ranked' => 'approved_date',
            'rating' => 'rating',
            'relevance' => '_score',
            'title' => 'title.raw',
            'updated' => 'last_update',
        ];

        return new Sort($fields[$sort->field] ?? null, $sort->order, $sort->mode);
    }
}
