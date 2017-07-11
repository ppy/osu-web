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

namespace App\Models;

class BeatmapPack extends Model
{
    protected $table = 'osu_beatmappacks';
    protected $primaryKey = 'pack_id';

    protected $dates = ['date'];
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(BeatmapPackItem::class, 'pack_id');
    }

    public function beatmapsets()
    {
        $thisTable = $this->getTable();
        $setsTable = (new Beatmapset)->getTable();
        $itemsTable = (new BeatmapPackItem)->getTable();
        return static::query()
            ->where("{$thisTable}.pack_id", '=', $this->pack_id)
            ->join($itemsTable, "{$itemsTable}.pack_id", '=', "{$thisTable}.pack_id")
            ->join($setsTable, "{$itemsTable}.beatmapset_id", '=', "{$setsTable}.beatmapset_id");
    }

    public function downloadUrls()
    {
        $array = [];
        foreach (explode(',', $this->url) as $url) {
            preg_match('@^(?:http[s]?://)?([^/]+)@i', $url, $hosts);
            $array[] = [
                'url' => $url,
                'host' => $hosts[1]
            ];
        }

        return $array;
    }
}
