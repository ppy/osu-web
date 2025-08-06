<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\Search\BeatmapsPassedSearch;
use App\Models\Traits\WithDbCursorHelper;
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
    use WithDbCursorHelper;

    protected const DEFAULT_SORT = 'id_desc';
    protected const SORTS = [
        'id_desc' => [
            ['column' => 'pack_id', 'order' => 'DESC'],
        ],
    ];

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

    public function userCompletionData($user, ?bool $isLegacy)
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

            $completedBeatmapIds = BeatmapsPassedSearch::completedIds(
                $userId,
                array_keys($beatmapsetIdsByBeatmapId),
                $this->no_diff_reduction,
                $this->playmode,
                $isLegacy,
                $this->playmode === null,
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
