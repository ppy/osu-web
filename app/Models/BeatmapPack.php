<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
