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

use App\Libraries\Elasticsearch\Sort;
use App\Models\Beatmap;
use App\Models\User;
use Illuminate\Http\Request;

class BeatmapsetSearchRequestParams extends BeatmapsetSearchParams
{
    public function __construct(Request $request, ?User $user = null)
    {
        static $validExtras = ['video', 'storyboard'];
        static $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];

        $this->user = $user;
        $this->page = get_int($request['page']) ?? 1;

        if ($this->user !== null) {
            $this->queryString = es_query_escape_with_caveats($request['q'] ?? $request['query']);
            $this->status = get_int($request['s']) ?? 0;
            $this->genre = get_int($request['g']);
            $this->language = get_int($request['l']);
            $this->extra = array_intersect(
                explode('.', $request['e']),
                $validExtras
            );

            $this->mode = get_int($request['m']);
            if (!in_array($this->mode, Beatmap::MODES, true)) {
                $this->mode = null;
            }

            $generals = explode('.', $request['c']) ?? [];
            $this->includeConverts = in_array('converts', $generals, true);
            $this->showRecommended = in_array('recommended', $generals, true);

            if ($this->user->isSupporter()) {
                $this->rank = array_intersect(
                    explode('.', $request['r'] ?? null),
                    $validRanks
                );

                $this->playedFilter = $request['played'];
                if (!in_array($this->playedFilter, static::PLAYED_STATES, true)) {
                    $this->playedFilter = null;
                }
            }
        }

        $sort = explode('_', $request['sort']);
        $this->sort = static::normalizeSort(
            [static::remapSortField(new Sort($sort[0] ?? null, $sort[1] ?? null))]
        );
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
