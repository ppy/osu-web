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
            static::normalizeParams($options)
        );

        $this->queryString = es_query_escape_with_caveats($options['query']);
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
        $params = $this->options;
        $query = (new BoolQuery());

        if (present($this->queryString)) {
            $query->must(QueryHelper::queryString($this->queryString));
        }

        if ($params['genre'] !== null) {
            $query->must(['match' => ['genre_id' => $params['genre']]]);
        }

        if ($params['language'] !== null) {
            $query->must(['match' => ['language_id' => $params['language']]]);
        }

        if (is_array($params['extra'])) {
            foreach ($params['extra'] as $val) {
                switch ($val) {
                    case 'video':
                        $query->must(['match' => ['video' => true]]);
                        break;
                    case 'storyboard':
                        $query->must(['match' => ['storyboard' => true]]);
                        break;
                }
            }
        }

        $this->addRankFilter($query);
        $this->addStatusFilter($query);

        if ($params['mode'] !== null) {
            $query->must(['match' => ['difficulties.playmode' => $params['mode']]]);
        }

        $this->sorts = $this->normalizeSort();

        $this->query($query);

        return parent::toArray();
    }

    public static function normalizeParams(array $params = [])
    {
        // simple stuff
        $params['query'] = presence($params['query'] ?? null);
        $params['status'] = get_int($params['status'] ?? null) ?? 0;
        $params['genre'] = get_int($params['genre'] ?? null);
        $params['language'] = get_int($params['language'] ?? null);
        $params['extra'] = explode('.', $params['extra'] ?? null);

        // mode
        $params['mode'] = get_int($params['mode'] ?? null);
        if (!in_array($params['mode'], Beatmap::MODES, true)) {
            $params['mode'] = null;
        }

        // rank
        $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];
        $params['rank'] = array_intersect($params['rank'] ?? [], $validRanks);

        return $params;
    }

    public static function remapSortField(Sort $sort)
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


    private function addRankFilter($query)
    {
        $params = $this->options;
        if (empty($params['rank'])) {
            return;
        }

        if ($params['mode'] !== null) {
            $modes = [$params['mode']];
        } else {
            $modes = array_values(Beatmap::MODES);
        }

        $unionQuery = null;
        foreach ($modes as $mode) {
            $newQuery =
                Score\Best\Model::getClass($mode)
                ->forUser($params['user'])
                ->whereIn('rank', $params['rank'])
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
        $params = $this->options;
        $query = new BoolQuery;

        switch ($params['status']) {
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
                $favs = model_pluck($params['user']->favouriteBeatmapsets(), 'beatmapset_id', Beatmapset::class);
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
                $maps = model_pluck($params['user']->beatmapsets(), 'beatmapset_id');
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

        if (in_array($this->options['status'], [4, 5, 6], true)) {
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
}
