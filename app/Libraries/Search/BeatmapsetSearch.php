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

namespace App\Libraries\Search;

use App\Libraries\Elasticsearch\BoolQuery;
use App\Libraries\Elasticsearch\QueryHelper;
use App\Libraries\Elasticsearch\RecordSearch;
use App\Libraries\Elasticsearch\Sort;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Score;

class BeatmapsetSearch extends RecordSearch
{
    public function __construct(array $options = [])
    {
        parent::__construct(
            Beatmapset::esIndexName(),
            Beatmapset::class,
            $options
        );

        static $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];
        static $validExtras = ['video', 'storyboard'];

        $this->queryString = es_query_escape_with_caveats($options['query']);
        $this->status = get_int($options['status'] ?? null) ?? 0;
        $this->genre = get_int($options['genre'] ?? null);
        $this->language = get_int($options['language'] ?? null);
        $this->extra = array_intersect($options['extra'] ?? [], $validExtras);
        $this->rank = array_intersect($options['rank'] ?? [], $validRanks);
        $this->user = $options['user'] ?? null;

        $this->mode = get_int($options['mode'] ?? null);
        if (!in_array($this->mode, Beatmap::MODES, true)) {
            $this->mode = null;
        }
    }

    public function getDefaultSize() : int
    {
        return config('osu.beatmaps.max');
    }

    public function records()
    {
        return $this->response()->records()->with('beatmaps')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function sort(Sort $sort)
    {
        static::remapSortField($sort);

        return parent::sort($sort);
    }

    public function toArray() : array
    {
        $query = (new BoolQuery());

        if (present($this->queryString)) {
            $query->must(QueryHelper::queryString($this->queryString));
        }

        $this->addGenreFilter($query);
        $this->addLanguageFilter($query);
        $this->addExtraFilter($query);
        $this->addRankFilter($query);
        $this->addStatusFilter($query);

        if ($this->mode !== null) {
            $query->must(['match' => ['difficulties.playmode' => $this->mode]]);
        }

        $this->sorts = $this->normalizeSort();

        $this->query($query);

        return parent::toArray();
    }

    private function addExtraFilter($query)
    {
        foreach ($this->extra as $val) {
            $query->filter(['term' => [$val => true]]);
        }
    }

    private function addGenreFilter($query)
    {
        if ($this->genre !== null) {
            $query->filter(['term' => ['genre_id' => $this->genre]]);
        }
    }

    private function addLanguageFilter($query)
    {
        if ($this->language !== null) {
            $query->filter(['term' => ['language_id' => $this->language]]);
        }
    }

    private function addRankFilter($query)
    {
        if (empty($this->rank)) {
            return;
        }

        if ($this->mode !== null) {
            $modes = [$this->mode];
        } else {
            $modes = array_values(Beatmap::MODES);
        }

        $unionQuery = null;
        foreach ($modes as $mode) {
            $newQuery =
                Score\Best\Model::getClass($mode)
                ->forUser($this->user)
                ->whereIn('rank', $this->rank)
                ->select('beatmap_id');

            if ($unionQuery === null) {
                $unionQuery = $newQuery;
            } else {
                $unionQuery->union($newQuery);
            }
        }

        $beatmapIds = model_pluck($unionQuery, 'beatmap_id');
        $beatmapsetIds = model_pluck(Beatmap::whereIn('beatmap_id', $beatmapIds), 'beatmapset_id');

        $query->filter(['ids' => ['type' => 'beatmaps', 'values' => $beatmapsetIds]]);
    }

    // statuses are non scoring for the query context.
    private function addStatusFilter($mainQuery)
    {
        $query = new BoolQuery;

        switch ($this->status) {
            case 0: // Ranked & Approved
                $query->should([
                    ['match' => ['approved' => Beatmapset::STATES['ranked']]],
                    ['match' => ['approved' => Beatmapset::STATES['approved']]],
                ]);
                break;
            case 1: // Approved
                $query->must(['match' => ['approved' => Beatmapset::STATES['approved']]]);
                break;
            case 8: // Loved
                $query->must(['match' => ['approved' => Beatmapset::STATES['loved']]]);
                break;
            case 2: // Favourites
                $favs = model_pluck($this->user->favouriteBeatmapsets(), 'beatmapset_id', Beatmapset::class);
                $query->must(['ids' => ['type' => 'beatmaps', 'values' => $favs]]);
                break;
            case 3: // Qualified
                $query->should([
                    ['match' => ['approved' => Beatmapset::STATES['qualified']]],
                ]);
                break;
            case 4: // Pending
                $query->should([
                    ['match' => ['approved' => Beatmapset::STATES['wip']]],
                    ['match' => ['approved' => Beatmapset::STATES['pending']]],
                ]);
                break;
            case 5: // Graveyard
                $query->must(['match' => ['approved' => Beatmapset::STATES['graveyard']]]);
                break;
            case 6: // My Maps
                $maps = model_pluck($this->user->beatmapsets(), 'beatmapset_id');
                $query->must(['ids' => ['type' => 'beatmaps', 'values' => $maps]]);
                break;
            case 7: // Explicit Any
                break;
            default: // null, etc
                break;
        }

        $mainQuery->filter($query);
    }

    private function defaultSort()
    {
        if (present($this->queryString)) {
            return new Sort('_score', 'desc');
        }

        if (in_array($this->status, [4, 5, 6], true)) {
            return new Sort('last_update', 'desc');
        }

        return new Sort('approved_date', 'desc');
    }

    /**
     * Generate sort parameters for the elasticsearch query.
     */
    private function normalizeSort()
    {
        // additional options
        static $orderOptions = [
            'difficulties.difficultyrating' => [
                'asc' => ['mode' => 'min'],
                'desc' => ['mode' => 'max'],
            ],
        ];

        if ($this->sorts === []) {
            return [$this->defaultSort()];
        }

        $newSort = [];
        foreach ($this->sorts as $sort) {
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

        $sort->field = $fields[$sort->field] ?? null;
    }
}
