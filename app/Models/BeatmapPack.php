<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

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

    protected $casts = ['hidden' => 'boolean'];

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
        $setsTable = (new Beatmapset)->getTable();
        $itemsTable = (new BeatmapPackItem)->getTable();

        return Beatmapset::query()
            ->join($itemsTable, "{$itemsTable}.beatmapset_id", '=', "{$setsTable}.beatmapset_id")
            ->where("{$itemsTable}.pack_id", '=', $this->pack_id);
    }

    public function downloadUrl()
    {
        return $this->downloadUrls()[0];
    }

    private function downloadUrls()
    {
        $array = [];
        foreach (explode(',', $this->url) as $url) {
            preg_match('@^https?://(?<host>[^/]+)@i', $url, $matches);
            $array[] = [
                'url' => $url,
                'host' => $matches['host'],
            ];
        }

        return $array;
    }
}
