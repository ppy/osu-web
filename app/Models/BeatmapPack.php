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

    // also display order for listing page
    const TAG_MAPPINGS = [
        'standard' => 'S',
        'featured' => 'F',
        'tournament' => 'P', // since 'T' is taken and 'P' goes for 'pool'
        'loved' => 'L',
        'chart' => 'R',
        'theme' => 'T',
        'artist' => 'A',
    ];

    protected $table = 'osu_beatmappacks';
    protected $primaryKey = 'pack_id';

    protected $casts = [
        'date' => 'datetime',
        'hidden' => 'boolean',
        'no_diff_reduction' => 'boolean',
    ];

    public $timestamps = false;

    public static function getPacks($type)
    {
        $tag = static::TAG_MAPPINGS[$type] ?? null;

        if ($tag === null) {
            return null;
        }

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
        return $this->hasManyThrough(
            Beatmapset::class,
            BeatmapPackItem::class,
            'pack_id',
            'beatmapset_id',
            null,
            'beatmapset_id',
        );
    }

    public function getRouteKeyName(): string
    {
        return 'tag';
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
