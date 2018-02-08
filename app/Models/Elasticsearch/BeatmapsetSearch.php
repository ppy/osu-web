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

namespace App\Models\Elasticsearch;

use App\Libraries\Elasticsearch\Search;
use App\Libraries\Elasticsearch\Query;
use App\Models\Beatmap;
use App\Models\Score;
use Datadog;

trait BeatmapsetSearch
{
    public static function search(array $params = [])
    {
        $startTime = microtime(true);
        $params = static::searchParams($params);
        $result = static::searchES($params);

        $data = count($result['ids']) > 0
            ? static
                ::with('beatmaps')
                ->whereIn('beatmapset_id', $result['ids'])
                ->orderByField('beatmapset_id', $result['ids'])
                ->get()
            : [];

        if (config('datadog-helper.enabled')) {
            $searchDuration = microtime(true) - $startTime;
            Datadog::microtiming(config('datadog-helper.prefix_web').'.search', $searchDuration, 1, ['type' => 'beatmapset']);
        }

        return [
            'data' => $data,
            'total' => min($result['total'], 10000),
        ];
    }

    public static function searchParams(array $params = [])
    {
        // simple stuff
        $params['query'] = presence($params['query'] ?? null);
        $params['status'] = get_int($params['status'] ?? null) ?? 0;
        $params['genre'] = get_int($params['genre'] ?? null);
        $params['language'] = get_int($params['language'] ?? null);
        $params['extra'] = explode('.', $params['extra'] ?? null);
        $params['limit'] = clamp(get_int($params['limit'] ?? config('osu.beatmaps.max')), 1, config('osu.beatmaps.max'));
        $params['page'] = max(1, get_int($params['page'] ?? 1));
        $params['offset'] = ($params['page'] - 1) * $params['limit'];

        // mode
        $params['mode'] = get_int($params['mode'] ?? null);
        if (!in_array($params['mode'], Beatmap::MODES, true)) {
            $params['mode'] = null;
        }

        // rank
        $validRanks = ['A', 'B', 'C', 'D', 'S', 'SH', 'X', 'XH'];
        $params['rank'] = array_intersect(explode('.', $params['rank'] ?? null), $validRanks);

        // sort_order, sort_field (and clear up sort)
        $sort = explode('_', array_pull($params, 'sort'));

        $validSortFields = [
            'artist' => 'artist',
            'creator' => 'creator',
            'difficulty' => 'difficulties.difficultyrating',
            'nominations' => 'nominations',
            'plays' => 'play_count',
            'ranked' => 'approved_date',
            'rating' => 'rating',
            'relevance' => '_score',
            'title' => 'title',
            'updated' => 'last_update',
        ];
        $params['sort_field'] = $validSortFields[$sort[0] ?? null] ?? null;

        $params['sort_order'] = $sort[1] ?? null;
        if (!in_array($params['sort_order'], ['asc', 'desc'], true)) {
            $params['sort_order'] = 'desc';
        }

        if ($params['sort_field'] === null) {
            if (present($params['query'])) {
                $params['sort_field'] = '_score';
                $params['sort_order'] = 'desc';
            } else {
                if (in_array($params['status'], [4, 5, 6], true)) {
                    $params['sort_field'] = 'last_update';
                    $params['sort_order'] = 'desc';
                } else {
                    $params['sort_field'] = 'approved_date';
                    $params['sort_order'] = 'desc';
                }
            }
        }

        return $params;
    }

    public static function searchES(array $params = [])
    {
        $query = (new Query())->shouldMatch(1);

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

        if (present($params['query'])) {
            $query->must(['query_string' => ['query' => es_query_escape_with_caveats($params['query'])]]);
        }

        if (!empty($params['rank'])) {
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

            $query->must(['ids' => ['type' => 'beatmaps', 'values' => $beatmapsetIds]]);
        }

        switch ($params['status']) {
            case 0: // Ranked & Approved
                $query->should([
                    ['match' => ['approved' => self::STATES['ranked']]],
                    ['match' => ['approved' => self::STATES['approved']]],
                ]);
                break;
            case 1: // Approved
                $query->must(['match' => ['approved' => self::STATES['approved']]]);
                break;
            case 8: // Loved
                $query->must(['match' => ['approved' => self::STATES['loved']]]);
                break;
            case 2: // Favourites
                $favs = model_pluck($params['user']->favouriteBeatmapsets(), 'beatmapset_id', self::class);
                $query->must(['ids' => ['type' => 'beatmaps', 'values' => $favs]]);
                break;
            case 3: // Qualified
                $query->should([
                    ['match' => ['approved' => self::STATES['qualified']]],
                ]);
                break;
            case 4: // Pending
                $query->should([
                    ['match' => ['approved' => self::STATES['wip']]],
                    ['match' => ['approved' => self::STATES['pending']]],
                ]);
                break;
            case 5: // Graveyard
                $query->must(['match' => ['approved' => self::STATES['graveyard']]]);
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

        if ($params['mode'] !== null) {
            $query->must(['match' => ['difficulties.playmode' => $params['mode']]]);
        }

        $search = (new Search(static::esIndexName()))
            ->size($params['limit'])
            ->from($params['offset'])
            ->sort(static::searchSortParamsES($params))
            ->source('_id')
            ->query($query);

        $response = $search->response();
        $beatmapsetIds = $response->ids();

        return [
            'ids' => $beatmapsetIds,
            'total' => $response->total(),
        ];
    }

    /**
     * Generate sort parameters for the elasticsearch query.
     */
    public static function searchSortParamsES(array $params)
    {
        static $fields = [
            'artist' => 'artist.raw',
            'creator' => 'creator.raw',
            'title' => 'title.raw',
        ];

        // additional options
        static $orderOptions = [
            'difficulties.difficultyrating' => [
                'asc' => ['mode' => 'min'],
                'desc' => ['mode' => 'max'],
            ],
        ];

        $sortField = $params['sort_field'];
        $sortOrder = $params['sort_order'];

        $field = $fields[$sortField] ?? $sortField;
        $options = ($orderOptions[$sortField] ?? [])[$sortOrder] ?? [];

        $sortFields = [
            $field => array_merge(
                ['order' => $sortOrder],
                $options
            ),
        ];

        // sub-sorting
        if ($params['sort_field'] === 'nominations') {
            $sortFields['hype'] = ['order' => $params['sort_order']];
        }

        return $sortFields;
    }
}
