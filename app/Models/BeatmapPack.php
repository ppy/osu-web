<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\Search\ScoreSearch;
use App\Libraries\Search\ScoreSearchParams;
use Ds\Set;

/**
 * @property string $author
 * @property \Carbon\Carbon $date
 * @property bool $hidden
 * @property \Illuminate\Database\Eloquent\Collection $items BeatmapPackItem
 * @property string $name
 * @property int $pack_id
 * @property int|null $playmode
 * @property string $tag
 * @property string $url
 */
class BeatmapPack extends Model
{
    const DEFAULT_TYPE = 'standard';
    private static $tagMappings = [
        'standard' => 'S',
        'theme' => 'T',
        'artist' => 'A',
        'chart' => 'R',
    ];

    protected $table = 'osu_beatmappacks';
    protected $primaryKey = 'pack_id';

    protected $casts = [
        'hidden' => 'boolean',
        'no_diff_reduction' => 'boolean',
    ];

    protected $dates = ['date'];
    public $timestamps = false;

    public static function getPacks($type)
    {
        if (!in_array($type, array_keys(static::$tagMappings), true)) {
            return;
        }

        $tag = static::$tagMappings[$type];

        return static::default()->where('tag', 'like', "{$tag}%")->orderBy('pack_id', 'desc');
    }

    public function scopeDefault($query)
    {
        $query->where(['hidden' => false]);
    }

    public function items()
    {
        return $this->hasMany(BeatmapPackItem::class);
    }

    public function beatmapsets()
    {
        $setsTable = (new Beatmapset())->getTable();
        $itemsTable = (new BeatmapPackItem())->getTable();

        return Beatmapset::query()
            ->join($itemsTable, "{$itemsTable}.beatmapset_id", '=', "{$setsTable}.beatmapset_id")
            ->where("{$itemsTable}.pack_id", '=', $this->pack_id);
    }

    public function userCompletionData($user)
    {
        if ($user !== null) {
            $userId = $user->getKey();

            $beatmaps = Beatmap
                ::whereIn('beatmapset_id', $this->items()->select('beatmapset_id'))
                ->select(['beatmap_id', 'beatmapset_id', 'playmode'])
                ->get();
            $beatmapsetIdsByBeatmapId = [];
            foreach ($beatmaps as $beatmap) {
                $beatmapsetIdsByBeatmapId[$beatmap->beatmap_id] = $beatmap->beatmapset_id;
            }
            $params = [
                'beatmap_ids' => array_keys($beatmapsetIdsByBeatmapId),
                'exclude_converts' => $this->playmode === null,
                'is_legacy' => true,
                'limit' => 0,
                'ruleset_id' => $this->playmode,
                'user_id' => $userId,
            ];
            if ($this->no_diff_reduction) {
                $params['exclude_mods'] = app('mods')->difficultyReductionIds->toArray();
            }

            static $aggName = 'by_beatmap';

            $search = new ScoreSearch(ScoreSearchParams::fromArray($params));
            $search->size(0);
            $search->setAggregations([$aggName => [
                'terms' => [
                    'field' => 'beatmap_id',
                    'size' => max(1, count($params['beatmap_ids'])),
                ],
                'aggs' => [
                    'scores' => [
                        'top_hits' => [
                            'size' => 1,
                        ],
                    ],
                ],
            ]]);
            $response = $search->response();
            $search->assertNoError();
            $completedBeatmapIds = array_map(
                fn (array $hit): int => (int) $hit['key'],
                $response->aggregations($aggName)['buckets'],
            );
            $completedBeatmapsetIds = (new Set(array_map(
                fn (int $beatmapId): int => $beatmapsetIdsByBeatmapId[$beatmapId],
                $completedBeatmapIds,
            )))->toArray();
            $completed = count($completedBeatmapsetIds) === count(array_unique($beatmapsetIdsByBeatmapId));
        }

        return [
            'completed' => $completed ?? false,
            'beatmapset_ids' => $completedBeatmapsetIds ?? [],
        ];
    }
}
