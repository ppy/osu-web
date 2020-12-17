<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Libraries\ModsHelper;
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
                                        $scoreQuery->withoutMods(ModsHelper::DIFFICULTY_REDUCTION_MODS);
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
                        $query->withoutMods(ModsHelper::DIFFICULTY_REDUCTION_MODS);
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
