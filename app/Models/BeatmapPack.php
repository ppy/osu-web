<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use Exception;

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
            $beatmapsetIds = $this->items()->pluck('beatmapset_id')->all();
            $query = Beatmap::select('beatmapset_id')->distinct()->whereIn('beatmapset_id', $beatmapsetIds);

            if ($this->playmode === null) {
                static $scoreRelations;

                // generate list of beatmap->score relation names for each modes
                // store int mode as well as it'll be used for filtering the scores
                if (!isset($scoreRelations)) {
                    $scoreRelations = [];
                    foreach (Beatmap::MODES as $modeStr => $modeInt) {
                        $scoreRelations[] = [
                            'playmode' => $modeInt,
                            'relation' => camel_case("scores_best_{$modeStr}"),
                        ];
                    }
                }

                // outer where function
                // The idea is SELECT ... WHERE ... AND (<has osu scores> OR <has taiko scores> OR ...).
                $query->where(function ($q) use ($scoreRelations, $userId) {
                    foreach ($scoreRelations as $scoreRelation) {
                        // The <has <mode> scores> mentioned above is generated here.
                        // As it's "playmode = <mode> AND EXISTS (<<mode> score for user>)",
                        // wrap them so it's not flat "playmode = <mode> AND EXISTS ... OR playmode = <mode> AND EXISTS ...".
                        $q->orWhere(function ($qq) use ($scoreRelation, $userId) {
                            $qq
                                // this playmode filter ensures the scores are limited to non-convert maps
                                ->where('playmode', '=', $scoreRelation['playmode'])
                                ->whereHas($scoreRelation['relation'], function ($scoreQuery) use ($userId) {
                                    $scoreQuery->where('user_id', '=', $userId);

                                    if ($this->no_diff_reduction) {
                                        $scoreQuery->withoutMods(app('mods')->difficultyReductionIds->toArray());
                                    }
                                });
                        });
                    }
                });
            } else {
                $modeStr = Beatmap::modeStr($this->playmode);

                if ($modeStr === null) {
                    throw new Exception("beatmapset pack {$this->getKey()} has invalid playmode: {$this->playmode}");
                }

                $scoreRelation = camel_case("scores_best_{$modeStr}");

                $query->whereHas($scoreRelation, function ($query) use ($userId) {
                    $query->where('user_id', '=', $userId);

                    if ($this->no_diff_reduction) {
                        $query->withoutMods(app('mods')->difficultyReductionIds->toArray());
                    }
                });
            }

            $completedBeatmapsetIds = $query->pluck('beatmapset_id')->all();
            $completed = count($completedBeatmapsetIds) === count($beatmapsetIds);
        }

        return [
            'completed' => $completed ?? false,
            'beatmapset_ids' => $completedBeatmapsetIds ?? [],
        ];
    }
}
